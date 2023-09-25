<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="" class="form-control" />
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea type="text" name="description" id="" class="form-control"></textarea>
</div>
<div class="form-group">
    <label for="location">Location</label>
    <input type="text" name="location" id="" class="form-control" />
</div>
<div class="row">
    <div class="col">

        <div class="form-group">
            <label for="location">Price</label>
            <input type="number" name="price_per_night" id="" class="form-control" />
        </div>
    </div>
    <div class="col">

        <div class="form-group">
            <label for="location">Discounted Price</label>
            <input type="number" name="discounted_price" id="" class="form-control" />
        </div>
    </div>
</div>

        <div class="form-group">
            <label for="location">No Of Guests</label>
            <input type="number" name="no_guests" id="" class="form-control" />
        </div>
<div class="form-group">
    <label for="client_id">Client</label>
    <select name="client_id" class="form-control" id="">
        @foreach ($clients as $client)
            <option value="{{$client->id}}">{{$client->names()}}</option>
        @endforeach
    </select>
</div>