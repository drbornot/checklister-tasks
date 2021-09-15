<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <ul class="c-sidebar-nav">

        @if(auth()->user()->is_admin)
            <li class="c-sidebar-nav-title">{{ __('Manage Checklists') }}</li>
            @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $group)
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown c-show">
                    <a class="c-sidebar-nav-link"
                             href="{{ route('admin.checklist_groups.edit', $group->id) }}">
                        <i class="cil-folder-open"></i>
                        <span class="p-2">{{ $group->name }}</span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @foreach($group->checklists as $checklist)
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" style="padding: .5rem .5rem .5rem 76px;"
                               href="{{ route('admin.checklist_groups.checklists.edit', [$group, $checklist]) }}">
                                <i class="cil-list"></i>
                                <span class="ml-1">{{ $checklist->name }}</span>
                            </a>
                        </li>
                        @endforeach
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="{{ route('admin.checklist_groups.checklists.create', $group) }}">
                                <i class="cil-plus"></i>
                                <span class="ml-1">{{ __('New Checklist') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endforeach
            <li class="c-sidebar-nav-title">
                <a class="c-sidebar-nav-link" href="{{ route('admin.checklist_groups.create') }}">
                    <i class="cil-library-add"></i>
                    <span class="ml-1">{{ __('New checklist group') }}</span>
                </a>
            </li>

            <li class="c-sidebar-nav-title">{{ __('Pages') }}</li>
            @foreach(\App\Models\Page::all() as $page)
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link"
                        href="{{ route('admin.pages.edit', $page) }}"><i class="cil-puzzle"></i>
                        <span class="p-2">{{ $page->title }}</span>
                    </a>
                </li>
            @endforeach

            <li class="c-sidebar-nav-title">{{ __('Manage Data') }}</li>
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link"
                                                                     href="{{ route('admin.users.index') }}"><i class="cil-puzzle"></i>
                    <span class="p-2">{{ __('Users') }}</span>
                </a>
            </li>
        @else
            @foreach($user_menu as $group)
                <li class="c-sidebar-nav-title">
                    {{ $group['name'] }}
                    @if($group['is_new'])
                        <span class="badge badge-info">NEW</span>
                    @elseif($group['is_updated'])
                        <span class="badge badge-info">UPD</span>
                    @endif
                </li>
                @foreach($group['checklists'] as $checklist)
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link"
                           href="{{ route('users.checklists.show', [$checklist['id']]) }}">
                            <i class="cil-list"></i>
                            <span class="ml-1 mr-1">{{ $checklist['name'] }}</span>
                            @livewire('completed-tasks-counter', [
                                'completed_tasks' => count($checklist['user_tasks']),
                                'tasks_count' => count($checklist['tasks']),
                                'checklist_id' => $checklist['id']
                            ])
                            @if($checklist['is_new'])
                                <span class="badge badge-info">NEW</span>
                            @elseif($checklist['is_updated'])
                                <span class="badge badge-info">UPD</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            @endforeach
        @endif

{{--        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">--}}
{{--                <svg class="c-sidebar-nav-icon">--}}
{{--                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-puzzle') }}"></use>--}}
{{--                </svg> {{ __('Base') }}</a>--}}
{{--            <ul class="c-sidebar-nav-dropdown-items">--}}
{{--                <li class="c-sidebar-nav-item">--}}
{{--                    <a class="c-sidebar-nav-link" href="base/breadcrumb.html">--}}
{{--                        <span class="c-sidebar-nav-icon"></span>--}}
{{--                        Breadcrumb--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}

{{--        <li class="c-sidebar-nav-title">{{ __('Others') }}</li>--}}
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('logout') }}"
                                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="cil-account-logout"></i>
                <span class="p-2">{{ __('Logout') }}</span>

            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
{{--        </li>--}}
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
