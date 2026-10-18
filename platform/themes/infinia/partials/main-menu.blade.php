<ul{!! BaseHelper::clean($options) !!}>
    @foreach($menu_nodes as $key => $row)
        <li @class(['nav-item', 'dropdown' => $row->has_child])>
            <a
                @class(['nav-link fw-bold text-nowrap d-md-flex align-items-center', 'dropdown-toggle' => $row->has_child, 'active' => $row->active, $row->css_class])
                href="{{ $row->url }}"
                target="{{ $row->target }}"
                @if($row->has_child)
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                @endif
            >
                {!! $row->icon_html !!}
                {{ $row->title }}
            </a>
            @if($row->has_child)
                <div class="dropdown-menu p-4">
                    {!! Menu::renderMenuLocation('main-menu', [
                       'view' => 'main-menu',
                       'menu' => $menu,
                       'menu_nodes' => $row->child,
                       'options' => ['class' => 'list-unstyled'],
                   ]) !!}
                </div>
            @endif
        </li>
    @endforeach
</ul>
