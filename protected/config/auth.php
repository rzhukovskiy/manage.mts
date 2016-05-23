<?php
return array(
    Employee::GUEST_ROLE => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'children' => array(),
        'bizRule' => null,
        'data' => null
    ),
    Employee::EMPLOYEE_ROLE => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Employee',
        'children' => array(
            'guest'
        ),
        'bizRule' => null,
        'data' => null
    ),
    Employee::ADMIN_ROLE => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            Employee::EMPLOYEE_ROLE
        ),
        'bizRule' => null,
        'data' => null
    ),
);