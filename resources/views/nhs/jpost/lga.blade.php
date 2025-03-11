@foreach ($lgas as $row)
<option value="{{ $row->id }}">{{ $row->name }}</option>
@endforeach
