<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label fw-bold">{{ __('Phụ đề') }}</label>
            <input type="text" name="subtitle" class="form-control" value="{{ Arr::get($attributes, 'subtitle') }}"
                placeholder="{{ __('Dự án tiêu biểu') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label fw-bold">{{ __('Tiêu đề') }}</label>
            <input type="text" name="title" class="form-control" value="{{ Arr::get($attributes, 'title') }}"
                placeholder="{{ __('Các dự án gần đây') }}">
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label fw-bold">{{ __('Mô tả') }}</label>
            <textarea name="description" class="form-control"
                rows="2">{{ Arr::get($attributes, 'description') }}</textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label fw-bold">{{ __('Số dự án mỗi trang') }}</label>
            <input type="number" name="per_page" class="form-control" value="{{ Arr::get($attributes, 'per_page', 9) }}"
                min="1" max="48">
            <small class="text-muted">{{ __('Mặc định: 9') }}</small>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label fw-bold">{{ __('Số cột hiển thị') }}</label>
            <select name="columns" class="form-control">
                @foreach(['2' => '2 cột', '3' => '3 cột', '4' => '4 cột', '6' => '6 cột'] as $val => $label)
                    <option value="{{ $val }}" {{ Arr::get($attributes, 'columns', '3') == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label fw-bold">{{ __('Sắp xếp mặc định') }}</label>
            <select name="default_sort" class="form-control">
                @foreach(['latest' => 'Mới nhất', 'oldest' => 'Cũ nhất', 'name_asc' => 'Tên A-Z', 'name_desc' => 'Tên Z-A', 'featured' => 'Nổi bật'] as $val => $label)
                    <option value="{{ $val }}" {{ Arr::get($attributes, 'default_sort', 'latest') == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label fw-bold">{{ __('Phong cách card') }}</label>
            <select name="card_style" class="form-control">
                <option value="default" {{ Arr::get($attributes, 'card_style', 'default') == 'default' ? 'selected' : '' }}>{{ __('Mặc định') }}</option>
                <option value="minimal" {{ Arr::get($attributes, 'card_style', 'default') == 'minimal' ? 'selected' : '' }}>{{ __('Tối giản') }}</option>
                <option value="hover" {{ Arr::get($attributes, 'card_style', 'default') == 'hover' ? 'selected' : '' }}>
                    {{ __('Hover effect') }}</option>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label fw-bold">{{ __('Hiển thị bộ lọc danh mục') }}</label>
            <select name="show_filter" class="form-control">
                <option value="yes" {{ Arr::get($attributes, 'show_filter', 'yes') == 'yes' ? 'selected' : '' }}>
                    {{ __('Có') }}</option>
                <option value="no" {{ Arr::get($attributes, 'show_filter', 'yes') == 'no' ? 'selected' : '' }}>
                    {{ __('Không') }}</option>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label fw-bold">{{ __('Hiển thị ô tìm kiếm') }}</label>
            <select name="show_search" class="form-control">
                <option value="yes" {{ Arr::get($attributes, 'show_search', 'yes') == 'yes' ? 'selected' : '' }}>
                    {{ __('Có') }}</option>
                <option value="no" {{ Arr::get($attributes, 'show_search', 'yes') == 'no' ? 'selected' : '' }}>
                    {{ __('Không') }}</option>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label fw-bold">{{ __('Hiển thị sắp xếp') }}</label>
            <select name="show_sort" class="form-control">
                <option value="yes" {{ Arr::get($attributes, 'show_sort', 'yes') == 'yes' ? 'selected' : '' }}>
                    {{ __('Có') }}</option>
                <option value="no" {{ Arr::get($attributes, 'show_sort', 'yes') == 'no' ? 'selected' : '' }}>
                    {{ __('Không') }}</option>
            </select>
        </div>
    </div>
</div>