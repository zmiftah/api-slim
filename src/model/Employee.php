<?php

namespace zmdev\app\model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  const CREATED_AT = 'created_stamp';
  const UPDATED_AT = 'updated_stamp';

  /**
   * The connection name for the model.
   *
   * @var string
   */
  protected $connection = 'default';
	/**
   * The table associated with the model.
   *
   * @var string
   */
	protected $table = 'sdm_employee';
	/**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
	public $timestamps = false;
}