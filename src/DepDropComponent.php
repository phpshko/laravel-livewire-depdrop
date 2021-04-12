<?php

namespace Phpshko\LaravelLivewireDepDrop;

use Livewire\Component;

abstract class DepDropComponent extends Component
{
    public const EVENT_DEPDROP_SELECTED = 'depdropSelected';

    public $depId;

    public $parentId;

    public $placeholder;

    public $name;

    public $cssClass;

    public $values = [];

    public $selectedValue = '';

    public $parentValue;

    public $hideOnParentEmpty = false;

    public $hideOnValuesEmpty = false;

    protected $view = 'dep-drop';

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    abstract public function getValues();

    public function mount()
    {
        $this->values = $this->getValues();
    }

    public function render()
    {
        return view('laravel-livewire-depdrop::' . $this->view, ['isShowDropdown' => $this->isShowDropdown()]);
    }


    /**
     * Not use a general event name, because it triggers all dropdowns handlers.
     * For 5 dropdown it make 25 ajax calls instead from 0 to 3 in this implements (0 for last child, 3 for root)
     */
    protected function getListeners(): array
    {
        if (!$this->parentId) {
            return [];
        }

        return [$this->getEventName($this->parentId) => 'depdropSelectedHandler'];
    }

    public function depdropSelectedHandler($parentValue): void
    {
        $this->parentValue = $parentValue;
        $this->values = $this->getValues();
        $this->selectedValue = null;

        /** Trigger depends dropdown */
        $this->emit($this->getEventName($this->depId), $this->selectedValue);
    }

    public function updatedSelectedValue(): void
    {
        $this->emit($this->getEventName($this->depId), $this->selectedValue);

        $this->emit(self::EVENT_DEPDROP_SELECTED, $this->depId, $this->selectedValue);
    }

    public function isShowDropdown(): bool
    {
        if ($this->hideOnValuesEmpty && empty($this->values)) {
            return false;
        }

        if ($this->hideOnParentEmpty && $this->parentId && $this->parentValue === null) {
            return false;
        }

        return true;
    }

    private function getEventName(string $depId): string
    {
        return 'depdropSelected_' . $depId;
    }
}
