<?php

return [
    'userManagement' => [
        'title'          => 'Administrador de Usuarios',
        'title_singular' => 'Administrador de Usuario',
    ],
    'permission'     => [
        'title'          => 'Permisos',
        'title_singular' => 'Permiso',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'                => 'Nombre',
            'name_helper'         => '',
            'title'             => 'Titulo',
            'title_helper'      => '',
            'created_at'        => 'Creado el',
            'created_at_helper' => '',
            'updated_at'        => 'Actualizado el',
            'updated_at_helper' => '',
            'deleted_at'        => 'Eliminado el',
            'deleted_at_helper' => '',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Titulo',
            'title_helper'       => '',
            'permissions'        => 'Permisos',
            'permissions_helper' => '',
            'created_at'         => 'Creado el',
            'created_at_helper'  => '',
            'updated_at'         => 'Actualizado el',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Eliminado el',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Nombre',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verificado el',
            'email_verified_at_helper' => '',
            'password'                 => 'Contraseña',
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'remember_token'           => 'Recordar Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Creado el',
            'created_at_helper'        => '',
            'updated_at'               => 'Actualizado el',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Eliminado el',
            'deleted_at_helper'        => '',
        ],
    ],
    'category'       => [
        'title'          => 'Categorias',
        'title_singular' => 'Categoría',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Nombre',
            'name_helper'       => '',
            'created_at'        => 'Creado el',
            'created_at_helper' => '',
            'updated_at'        => 'Actualizado el',
            'updated_at_helper' => '',
            'deleted_at'        => 'Eliminado el',
            'deleted_at_helper' => '',
        ],
    ],
    'shop'           => [
        'title'          => 'Tiendas',
        'title_singular' => 'Tienda:',
        'from'           => 'desde las',
        'to'              => 'hasta las',

        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => '',
            'name'                 => 'Nombre',
            'name_helper'          => '',
            'categories'           => 'Categorías',
            'categories_helper'    => 'ayuda',
            'description'          => 'Descripción',
            'description_helper'   => '',
            'photos'               => 'Fotos',
            'photos_helper'        => '',
            'address'              => 'Dirección',
            'address_helper'       => '',
            'active'               => 'Activo',
            'active_helper'        => '',
            'working_hours'        => 'Horario de Trabajo',
            'working_hours_helper' => '',
            'created_at'           => 'Creado el',
            'created_at_helper'    => '',
            'updated_at'           => 'Actualizado el',
            'updated_at_helper'    => '',
            'deleted_at'           => 'Eliminado el',
            'deleted_at_helper'    => '',
            'created_by'           => 'Creado Por',
            'created_by_helper'    => '',
        ],
    ],
];
