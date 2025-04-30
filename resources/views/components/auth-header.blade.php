@props([
    'title',
    'description',
    'subtitle',
])

<div class="flex w-full flex-col text-center">
    <flux:heading size="xl">{{ $title }}</flux:heading>
    <flux:heading>{{ $subtitle }}</flux:heading>
    <flux:subheading>{{ $description }}</flux:subheading>
</div>
