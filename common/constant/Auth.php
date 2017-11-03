<?php
/**
 * Created by PhpStorm.
 * User: dangnh
 * Date: 10/19/17
 * Time: 2:00 AM
 */

namespace common\constant;

class Auth
{
    /* Roles */
    const ROLE_ADMIN = 'admin';
    const ROLE_CONTRIBUTOR = 'contributor';
    /* END Roles */

    /* Permissions */
    //User
    const PERM_MANAGE_USER = 'manageUser';
    const PERM_ADD_USER = 'addUser';
    const PERM_VIEW_USER = 'viewUser';
    const PERM_EDIT_USER = 'editUser';
    const PERM_DELETE_USER = 'deleteUser';
    const PERM_APPROVE_USER = 'approveUser';

    //Ginseng
    const PERM_MANAGE_GINSENG = 'manageGinseng';
    const PERM_ADD_GINSENG = 'addGinseng';
    const PERM_VIEW_GINSENG = 'viewGinseng';
    const PERM_EDIT_GINSENG = 'editGinseng';
    const PERM_DELETE_GINSENG = 'deleteGinseng';

    //Draft
    const PERM_APPROVE_DRAFT = 'approveDraft';
    /* END Permissions */

}
