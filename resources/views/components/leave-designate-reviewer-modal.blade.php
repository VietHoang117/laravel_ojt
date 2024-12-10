<div class="modal fade" id="approvalFormModal-{{ $value->id }}" tabindex="-1" role="dialog"
    aria-labelledby="approvalFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="approvalFormModalLabel">Chỉ chỉ đích danh người
                    duyệt</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('leaves.approval', ['id' => $value->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="approver">Người duyệt:</label>
                        <select class="form-control" id="approver" name="approver">
                            <option value="">Chọn người duyệt</option>
                            <!-- Thêm các option trong backend -->
                            @foreach ($nguoiquanlys as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Xác nhận</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>