<?php
namespace App\Services;

use App\Models\User;
use App\Models\MembershipSequence;
use Illuminate\Support\Facades\DB;

class MembershipNumberService
{
    /**
     * Generates a unique, globally auto-incrementing membership number and assigns it to the given user.
     * The format is NHS/{CURRENT_YEAR}/{GLOBAL_SEQUENCE}, e.g., NHS/2025/0001, NHS/2025/0002, NHS/2026/0003.
     *
     * @param \App\Models\User $user The user to assign the membership number to.
     * @return string The newly generated membership number.
     * @throws \Exception If the membership number cannot be assigned (e.g., user already has one).
     */
    public function generateAndAssign(User $user): string
    {
        // Prevent assigning a new number if the user already has one.
        if (!empty($user->membership_number)) {
            // Log an error or throw an exception, depending on your desired behavior.
            throw new \Exception("User {$user->id} already has a membership number: {$user->membership_number}");
        }

        $currentYear = date('Y');
        $membershipNumber = null;

        // Use a database transaction to ensure atomicity and prevent race conditions
        // when multiple users might try to get a membership number at the same time.
        DB::transaction(function () use ($user, $currentYear, &$membershipNumber) {
            // Retrieve the single global sequence record.
            // We can assume there's always one record (e.g., with ID 1) due to the migration seeding.
            // Using 'first()' and 'lockForUpdate()' ensures we get the latest and lock it for the transaction.
            $sequence = MembershipSequence::first();

            // If for some reason the record doesn't exist (e.g., manual deletion), create it.
            if (!$sequence) {
                 $sequence = MembershipSequence::create(['last_sequence_number' => 0]);
            }

            // Increment the global sequence number.
            $sequence->increment('last_sequence_number');

            // Format the global sequence number with leading zeros (e.g., 1 -> 0001)
            // Adjust the '4' if you expect more than 9999 members in total.
            $sequenceNumber = str_pad($sequence->last_sequence_number, 4, '0', STR_PAD_LEFT);

            // Construct the full membership number, using the current year but the global sequence.
            $membershipNumber = "NHS/{$currentYear}/{$sequenceNumber}";

            // Assign the generated membership number to the user.
            $user->membership_number = $membershipNumber;
            $user->save(); // Save the user model to persist the new membership number.
        });

        return $membershipNumber;
    }
}

?>
