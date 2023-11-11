
@foreach($chilCats as $chil)
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
                    @if ($count < 3)
                        <li class="sort_list-item">
                            <a class="">{{$schil->Categories_name}}</a>
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
