<!DOCTYPE html>
<html lang="en-us">
    @include('admin.master_inc.head')
    <body >
        @include('admin.master_inc.header')
        @include('admin.master_inc.nav', array('config_menu' => App\Libraries\AdminLib\Menu::getMenu()))
        @include('admin.master_inc.main')
        @include('admin.master_inc.footer')
        @include('admin.master_inc.scripts')
    </body>
</html>