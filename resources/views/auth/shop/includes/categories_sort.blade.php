@php
    $CatController=new \App\Http\Controllers\CategoriesController();
    $childCat=$CatController->__getCats(session('selected'));
@endphp
<div class="categories_sort active">
    <div class="row" id="childCategories" >
        {{-- chilCategories --}}
        @foreach($childCat as $chil)
            <div class="col">
                <div class="text">
                    {{$chil->Categories_name}}
                </div>
                <ul class="sort_list">
                    @php
                        $catController=new \App\Http\Controllers\CategoriesController();
                        $schilCats=$catController->__getCats($chil->Api_value);
                        $count=0;
                    @endphp
                    @if(count($schilCats)>0)
                        @foreach ($schilCats as $schil)
                            @if ($count < 6)
                                <li class="sort_list-item">
                                    <a class="{{ (session('childSelected') == $schil->Api_value) ? 'active' : '' }}" href="{{route('shopList',['value'=>$schil->Api_value])}}">{{$schil->Categories_name}}</a>
                                </li>
                            @endif
                            @php $count++ @endphp
                        @endforeach
                        @if(count($schilCats)>4)
                            <li class="sort_list-item">
                                <a class="">More</a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        @endforeach
    </div>
</div>
