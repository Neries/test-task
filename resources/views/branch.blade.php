<ul class="ul-treefree">
    @foreach($children as $child)
        <li>
                <a class="list-group-item flex-column align-items-start">

                    <kbd>ФИО</kbd>
                    {{ ' '.$child->last_name.' '.$child->first_name.' '.$child->patronymic  }}<br>
                    <kbd>должность</kbd>

                    <nobr class="text-primary">{{ ' '.$child->position  }}</nobr>
                </a>

                @if(!empty($child->children))
                    @include('branch',['children' => $child->children])
                @endif
        </li>
    @endforeach
</ul>
