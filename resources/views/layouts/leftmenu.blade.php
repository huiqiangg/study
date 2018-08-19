@if(isset($menus[getTopRecord()['name']]))
        <ul class="list-group"><a href="#" class="list-group-item active">菜单信息 <span class="fa arrow"></span></a>
            @foreach($menus[getTopRecord()['name']]['_child'] as $m)
            <li class="list-group-item"><a class="menu" href="{{route($m['name'])}}"> {{ $m['display_name'] }}</a></li>
            @endforeach
        </ul>
@endif