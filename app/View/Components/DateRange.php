<?php

namespace App\View\Components;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DateRange extends Component
{
	public string $id;
	public string $name;
	public ?string $value;
	public ?string $label;
	public string $min;
	public string $max;
	
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		string $id,
		string $name,
		?string $value = null,
		?string $label = null,
		?string $min = null,
		?string $max = null,
		?int $subYears = null,
		?int $addYears = null
	) {
		$today = Carbon::today();

		// Si pasa min/max explícito → se respeta
		$this->min = $min ?? ($subYears ? $today->copy()->subYears($subYears)->format('Y-m-d') : '');
		$this->max = $max ?? ($addYears ? $today->copy()->addYears($addYears)->format('Y-m-d') : '');

		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
		$this->label = $label;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.date-range');
	}
}