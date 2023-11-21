
<section>
    <form class="catDetail" action="{{route('updateCat')}}" method="post">
        @csrf
        <label for="categoriesCid">{{"Cid: #00".$cat->Cid}}</label>
        <input type="hidden" name="Cid" value="{{$cat->Cid}}" id="">
        <label for="categoriesCid">Categories_name:</label>
        <input type="text" id="casSearch" name="name" value="{{$cat->Categories_name}}" required>
        <label for="categoriesCid">Api_value:</label>
        <input type="text" id="casSearch" name="Api_value" value="{{$cat->Api_value}}" required>
        <label for="categoriesCid">Api_code:</label>
        <input type="text" id="casSearch" name="Api_code" value="{{$cat->Api_code}}" required>
        <div class="btns_div">
            <button type="submit" class="admin_btns">Change </button>
        </div>
    </form>
</section>
