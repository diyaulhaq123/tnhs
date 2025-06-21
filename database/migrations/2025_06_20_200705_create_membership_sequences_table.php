<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the old table if it exists to replace it with the new structure for a global counter.
        Schema::dropIfExists('membership_sequences');

        // This table will now store a single global last_sequence_number.
        Schema::create('membership_sequences', function (Blueprint $table) {
            $table->id(); // This will typically be ID 1 for our single global record.
            $table->integer('last_sequence_number')->default(0)->comment('The last global sequence number issued.');
            $table->timestamps();
        });

        // Optional: Seed the first record right after creation.
        // This ensures there's always a record to increment.
        DB::table('membership_sequences')->insert([
            'last_sequence_number' => 1000, // Starting from 1000 as per your requirement.
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'membership_number')) {
                $table->dropColumn('membership_number');
            }
        });
    }
};
