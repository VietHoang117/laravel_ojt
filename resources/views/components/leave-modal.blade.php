<form action="{{ route('leaves.save') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Đề Xuất</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-8">
                        <label for="type" class="form-label">Loại đề xuất</label>
                        <select class="form-select" id="type" name="proposal_type_id"
                            onchange="toggleDateFields()">
                            <option value="">Chọn loại đề xuất</option>
                            @foreach ($dexuats as $item)
                                <option value="{{ $item->type_name }}">{{ $item->type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="date-fields" style="display: none;">
                        <div class="form-group">
                            <label for="type" class="form-label">Loại nghỉ</label>
                            <select class="form-select" id="type" name="type_of_vacation"
                                onchange="toggleDateFields()">
                                <option value="">Chọn loại đề xuất</option>
                                @foreach ($typeOfVacations as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-8">
                        <label for="type" class="form-label">Chọn kiểu nghỉ</label>
                        <select class="form-select" id="type" name="rest_type">
                            <option value="">Chọn kiểu nghỉ</option>
                            @foreach ($restTypes as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <p>
                            Số phép đã nghỉ: {{ $ngayPheps->used_leaves ?? 0 }}
                        </p>
                        <p>
                            Tổng số phép trong năm: {{ $ngayPheps->total_leaves ?? 0 }}
                        </p>
                        <p>
                            Số phép còn lại: {{ $ngayPheps->remaining_leaves ?? 0 }}
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="proposal_name" class="col-form-label">Tên Đề Xuất:</label>
                        <input type="text" class="form-control" id="proposal_name" name="proposal_name">
                    </div>

                    <div class="form-group">
                        <label for="content" class="col-form-label">Nội Dung:</label>
                        <textarea class="form-control" id="content" name="content"></textarea>
                    </div>


                    <div>
                        <div class="form-group">
                            <label for="from_date" class="col-form-label">Từ ngày:</label>
                            <input type="date" class="form-control" id="from_date" name="from_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="day_off" class="col-form-label">Đến ngày:</label>
                        <input type="date" class="form-control" id="to_date" name="to_date">
                    </div>

                    <div class="form-group">
                        <label for="attachments" class="form-label">Tệp đính kèm</label>
                        <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                        <small class="form-text text-muted">Kéo thả tệp đính kèm vào đây.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </div>
            </div>
        </div>
    </div>
</form>
