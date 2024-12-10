<div class="modal fade" id="approvalFormModalUser-{{ $value->id }}" tabindex="-1" role="dialog"
    aria-labelledby="approvalFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="approvalFormModalLabel">Duyệt</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('leaves.browse', ['id' => $value->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="approver">Chọn trạng thái:</label>
                        <select class="form-control" id="approver" name="browse">
                            <option value="">Chọn trạng thái</option>
                            <option value="{{ $leaveStatusEnum::ACCEPT }}">
                                {{ $leaveStatusEnum::ACCEPT }}
                            </option>
                            <option value="{{ $leaveStatusEnum::REFUSE }}">
                                {{ $leaveStatusEnum::REFUSE }}
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Xác nhận</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>