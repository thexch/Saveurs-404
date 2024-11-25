<div>
    <input type="text" wire:model.live="name" placeholder="Name">
    <input type="email" wire:model.live="email" placeholder="Email">
    <input type="text" wire:model.live="phone" placeholder="Phone">
    <input type="date" wire:model.live="date">
    <input type="time" wire:model.live="time">
    <input type="number" wire:model.live="guests" placeholder="Number of Guests">
    <button wire:click="submit">Réserver</button>
</div>

