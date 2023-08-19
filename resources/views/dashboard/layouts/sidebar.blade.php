<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
<div class="sticky">
    <aside class="app-sidebar sidebar-scroll">
        <div class="main-sidebar-header active">
            {{-- <a class="desktop-logo logo-light active" href="index.html"><img
                    src="{{ asset('dashboard/img/brand/logo-light.png') }}" class="main-logo" alt="logo"></a>
            <a class="desktop-logo logo-dark active" href="index.html"><img
                    src="{{ asset('dashboard/img/brand/logo-light.png') }}" class="main-logo" alt="logo"></a>
            <a class="logo-icon mobile-logo icon-light active" href="index.html"><img
                    src="{{ asset('dashboard/img/brand/logo-light.png') }}" alt="logo"></a>
            <a class="logo-icon mobile-logo icon-dark active" href="index.html"><img
                    src="{{ asset('dashboard/img/brand/logo-light.png') }}" alt="logo"></a> --}}
        </div>
        <div class="main-sidemenu">
            <div class="app-sidebar__user clearfix">
                <div class="dropdown user-pro-body">
                    <div class="main-img-user avatar-xl">
                        <img alt="user-img" src="{{ asset('dashboard/img/users/6.jpg') }}"><span
                            class="avatar-status profile-status bg-green"></span>
                    </div>
                    <div class="user-info">
                        <h4 class="fw-semibold mt-3 mb-0">{{ auth()->user()->name }}</h4>
                        <span class="mb-0 text-muted">{{ auth()->user()->email }}</span>
                    </div>
                </div>
            </div>
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="side-item side-item-category">{{ __('Main') }}</li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('home') }}">
                        <img class="side-menu__icon mCS_img_loaded"
                            src="https://img.icons8.com/fluency/48/000000/dashboard-layout.png"
                            style=" width: 30px; height: 30px;">
                        <span class="side-menu__label">{{ __('Home') }}</span><span
                            class="badge bg-success text-light bg-side-text">1</span></a>
                </li>
                <li class="side-item side-item-category">{{ __('General') }}</li>
                @can('admin-view')
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('admin.index') }}">
                            <img class="side-menu__icon mCS_img_loaded"
                                src="https://img.icons8.com/external-icongeek26-outline-colour-icongeek26/64/000000/external-monitor-online-education-icongeek26-outline-colour-icongeek26-1.png"
                                style=" width: 30px; height: 30px;">
                            <span class="side-menu__label">{{ __('Admins') }}</span></a>
                    </li>
                @endcan
                @can('role-view')
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('role.index') }}">
                            <img class="side-menu__icon mCS_img_loaded" src="https://img.icons8.com/nolan/344/service.png"
                                style=" width: 30px; height: 30px;">
                            <span class="side-menu__label">{{ __('Roles') }}</span></a>
                    </li>
                @endcan
                {{-- @can('copoun-view')
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('copoun.index') }}">
                            <img class="side-menu__icon mCS_img_loaded" src="https://img.icons8.com/?size=512&id=48142&format=png"
                                style=" width: 30px; height: 30px;">
                            <span class="side-menu__label">{{ __('Copouns') }}</span></a>
                    </li>
                @endcan --}}
                @can('ad-view')
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('ad.index') }}">
                            <img class="side-menu__icon mCS_img_loaded"
                                src="https://img.icons8.com/external-icongeek26-outline-colour-icongeek26/344/external-ads-ads-icongeek26-outline-colour-icongeek26-7.png"
                                style=" width: 30px; height: 30px;">
                            <span class="side-menu__label">{{ __('Ads') }}</span></a>
                    </li>
                @endcan
                {{-- @can('category-view')
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('category.index') }}">
                            <img class="side-menu__icon mCS_img_loaded"
                                src="https://img.icons8.com/nolan/344/categorize.png" style=" width: 30px; height: 30px;">
                            <span class="side-menu__label">{{ __('Categories') }}</span></a>
                    </li>
                @endcan --}}



                {{-- @can('attribute-view')
                    <li class="slide">
                        <a class="side-menu__item" href="{{route('attribute.index')}}">
                            <img class="side-menu__icon mCS_img_loaded"
                                src="https://img.icons8.com/nolan/344/categorize.png" style=" width: 30px; height: 30px;">
                            <span class="side-menu__label">{{ __('Attribute') }}</span></a>
                    </li>
                @endcan

                @can('product-view')
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('product.index') }}">
                            <img class="side-menu__icon mCS_img_loaded"
                                src="https://img.icons8.com/nolan/344/categorize.png" style=" width: 30px; height: 30px;">
                            <span class="side-menu__label">{{ __('Product') }}</span></a>
                    </li>
                @endcan

                @can('variant-view')
                    <li class="slide">
                        <a class="side-menu__item" href="{{route('variant.index')}}">
                            <img class="side-menu__icon mCS_img_loaded"
                                src="https://img.icons8.com/nolan/344/categorize.png" style=" width: 30px; height: 30px;">
                            <span class="side-menu__label">{{ __('Variant') }}</span></a>
                    </li>
                @endcan --}}

                {{-- @can('product-view')
                <div class="mb-3 mb-xl-0">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary">{{ __('Product') }}</button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
                            <a class="dropdown-item" href="{{route('attribute.index')}}">Attribute</a>
                            <a class="dropdown-item" href="{{route('product.index')}}">Product</a>
                            <a class="dropdown-item" href="{{route('variant.index')}}">Variant</a>

                        </div>
                    </div>
                </div>
                @endcan --}}

                 @can('product-view')
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <img class="side-menu__icon mCS_img_loaded" style=" width: 30px; height: 30px;"
                        src="https://img.icons8.com/nolan/344/product.png"
                        style=" width: 30px; height: 30px;">
                        <span class="side-menu__label">{{ __('Product') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu" style="display: none;">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane tab-content-show active" id="side26">
                                        <ul class="sidemenu-list">
                                            <li class="side-menu__label1"><a
                                                    href="javascript:void(0);">{{ __('Products') }}</a></li>
                                                    @can('category-view')
                                                    <li > <a class="slide-item" href="{{ route('category.index') }}">
                                                    {{ __('Categories') }}</a> </li>
                                                    @endcan

                                                    @can('copoun-view')
                                                    <li>
                                                        <a class="slide-item" href="{{ route('copoun.index') }}">
                                                        {{ __('Copouns') }}</a>
                                                    </li>
                                                @endcan


                                            <li><a class="slide-item" href="{{route('attribute.index')}}">{{ __('Attribute') }}</a></li>
                                             <li><a class="slide-item" href="{{ route('product.index') }}">{{ __('Product') }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            @endcan


            @can('order-view')
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('order.index') }}">
                            <img class="side-menu__icon mCS_img_loaded"
                                src="https://img.icons8.com/?size=512&id=43993&format=png"
                                style=" width: 30px; height: 30px;">
                            <span class="side-menu__label">{{ __('Orders') }}</span></a>
                    </li>
                @endcan

                {{-- @can('contact-view')
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('contact.index') }}">
                        <img class="side-menu__icon mCS_img_loaded"
                            src="https://img.icons8.com/?size=512&id=43993&format=png" style=" width: 30px; height: 30px;">
                        <span class="side-menu__label">{{ __('Contacts Us') }}</span></a>
                </li>
            @endcan --}}


                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <img class="side-menu__icon mCS_img_loaded" style=" width: 30px; height: 30px;"
                                src="https://img.icons8.com/nolan/64/categorize--v1.png">
                            <span class="side-menu__label">{{ __('Cities') }}</span><i
                                class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu" style="display: none;">
                            <li class="panel sidetab-menu">
                                <div class="panel-body tabs-menu-body p-0 border-0">
                                    <div class="tab-content">
                                        <div class="tab-pane tab-content-show active" id="side26">
                                            <ul class="sidemenu-list">
                                                <li class="side-menu__label1"><a
                                                        href="javascript:void(0);">{{ __('Cities') }}</a></li>
                                                <li><a class="slide-item"
                                                        href="{{ route('city.create') }}">{{ __('Add City') }}</a>
                                                </li>
                                                <li><a class="slide-item"
                                                        href="{{ route('city.index') }}">{{ __('AlL Cities') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>


                @can('setting-view')
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <img class="side-menu__icon mCS_img_loaded" style=" width: 30px; height: 30px;"
                                src="https://img.icons8.com/nolan/64/settings--v1.png">
                            <span class="side-menu__label">{{ __('Settings') }}</span><i
                                class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu" style="display: none;">
                            <li class="panel sidetab-menu">
                                <div class="panel-body tabs-menu-body p-0 border-0">
                                    <div class="tab-content">
                                        <div class="tab-pane tab-content-show active" id="side26">
                                            <ul class="sidemenu-list">
                                                <li class="side-menu__label1"><a
                                                        href="javascript:void(0);">{{ __('Settings') }}</a></li>
                                                <li><a class="slide-item"
                                                        href="{{ route('setting.index') }}">{{ __('General Settings') }}</a>
                                                </li>
                                                <li><a class="slide-item"
                                                        href="{{ route('social.index') }}">{{ __('Social Media Settings') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endcan
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </aside>
</div>
