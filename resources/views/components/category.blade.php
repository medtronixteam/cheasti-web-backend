@props(['category'])

<div class="card category-card">
    <div class="card-header p-2 bg-primary">
        <h5 class="text-white mt-2">{{ $category->name }}</h5>
    </div>
    <div class="card-body">
        <ul class="mt-0">
            @if($category->children->count())
                @foreach($category->children as $child)
                    <li>
                        {{ $child->name }}
                        <a href="javascript:void(0)" onclick="">
                            <i class="text-primary mdi mdi-tooltip-edit"></i>
                        </a>
                        <x-category :category="$child" />
                    </li>
                @endforeach
            @else
                <li>No subcategory</li>
            @endif
        </ul>
    </div>
</div>
