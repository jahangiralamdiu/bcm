<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 7/31/19
 * Time: 7:51 PM
 */

namespace App\constants;


abstract class ExpenseStatus
{
    const PENDING = 'Pending';
    const READY_FOR_DISBURSED = 'Ready for disbursement';
    const APPROVED = 'Approved';
    const REJECTED = 'Rejected';
}