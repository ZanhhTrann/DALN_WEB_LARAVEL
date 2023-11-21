
<section>
    <form class="catDetail" action="{{route('addCat')}}" method="post">
        @csrf
        {{-- <label for="categoriesCid">{{"Cid: #00".$cat->Cid}}</label> --}}
        <label for="categoriesCid">Categories_name:</label>
        <input type="text" id="casSearch" name="name" value="" required>
        <label for="categoriesCid">Api_value:</label>
        <input type="text" id="casSearch" name="Api_value" value="" required>
        <label for="categoriesCid">Api_code:</label>
        <input type="text" id="casSearch" name="Api_code" value="" required>
        <div class="btns_div">
            <button type="submit" class="admin_btns">Add </button>
        </div>
    </form>
</section>
