<section>
    <form class="catDetail" action="{{route('addProd')}}" method="post">
        @csrf
        {{-- <label for="categoriesCid">{{"Pid: #000".$product->Pid}}</label> --}}
        <input type="hidden" name="pid" value="">
        <label for="categoriesCid">Cid:</label>
        <input type="text" class="casSearch" name="cid" value="" required>
        <label for="categoriesCid">Product_name:</label>
        <input type="text" class="casSearch" name="name" value="" required>
        <label for="categoriesCid">Main Img:</label>
        <input type="text" id="fileInput" class="casSearch" name="imgChanges" placeholder="enter link img">
        <label for="categoriesCid">Price:</label>
        <input type="text" class="casSearch" name="price" value="" required>
        <label for="categoriesCid">Imgs:</label>
        <textarea type="text" class="casSearch long" name="imgs"  required></textarea>
        <label for="categoriesCid">Colors:</label>
        <textarea type="text" class="casSearch long" name="colors" required></textarea>
        <label for="categoriesCid">Sizes:</label>
        <textarea class="casSearch long" name="sizes" required></textarea>
        <label for="categoriesCid">Description:</label>
        <textarea  class="casSearch long" name="des" required></textarea>
        <label for="categoriesCid">Quantit:</label>
        <input type="text" class="casSearch" name="quantit" value="" required>
        <label for="categoriesCid">Api_code:</label>
        <input type="text" class="casSearch" name="Api_code" value="" required>
        <div class="btns_div">
            <button type="submit" class="admin_btns">Add</button>
        </div>
    </form>
</section>
