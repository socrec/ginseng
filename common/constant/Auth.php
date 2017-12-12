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

    //
    const PERM_MANAGE_ARTICLE = 'manageArticle';
    const PERM_ADD_ARTICLE = 'addArticle';
    const PERM_VIEW_ARTICLE = 'viewArticle';
    const PERM_EDIT_ARTICLE = 'editArticle';
    const PERM_DELETE_ARTICLE = 'deleteArticle';

    //Draft
    const PERM_APPROVE_DRAFT = 'approveDraft';
    const PERM_ADD_DRAFT = 'addDraft';
    const PERM_VIEW_DRAFT = 'viewDraft';
    const PERM_DELETE_DRAFT = 'deleteDraft';
    /* END Permissions */

}
