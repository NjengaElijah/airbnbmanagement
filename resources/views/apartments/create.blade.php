

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="" class="form-control">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <input type="text" name="description" id="" class="form-control">
</div>
<div class="form-group">
    <label for="location">Location</label>
    <input type="text" name="location" id="" class="form-control">
</div>
<div class="form-group">
    <label for="coordinates">Coordinates</label>
    <input type="text" name="coordinates" id="" class="form-control">
</div>
<div class="form-group">
    <label for="email">Client</label>
    <select name="client_id" class="form-control">
        @foreach ($clients as $client)
            <option value="{{ $client->id }}">{{ $client->names() }}</option>
        @endforeach
    </select>
</div>
