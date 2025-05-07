@props([
    'title',
    'description',
    'subtitle'=>'',
])

<div class="flex w-full flex-col text-center">
    <div class="flex justify-center">
        <img class="w-[150px]" src="{{asset('assets/images/bbroom-logo.png') }}" alt="Image" />
    </div>
    <flux:heading>{{ $subtitle }}</flux:heading>
    <flux:subheading>{{ $description }}</flux:subheading>
</div>
