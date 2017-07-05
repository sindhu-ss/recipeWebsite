<?php

namespace App\Views;

abstract class TemplateView extends View
{
	abstract protected function content();
}