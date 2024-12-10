<div class="modal fade" id="showFormModal-{{ $data->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="showFormModalLabel-{{ $data->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="showFormModalLabel-{{ $data->id }}">
                                            Thông tin chi tiết - {{ $data->proposal_name }}
                                        </h5>
                                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body bg-light">
                                        <!-- Hiển thị thông tin chi tiết -->
                                        <div class="row mb-3">
                                            <div class="col-sm-4 text-end fw-bold">Mã số:</div>
                                            <div class="col-sm-8 text-dark">{{ $data->id }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4 text-end fw-bold">Loại đề xuất:</div>
                                            <div class="col-sm-8 text-dark">{{ $data->type->type_name ?? 'Chưa có' }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-4 text-end fw-bold">Tên đề xuất:</div>
                                            <div class="col-sm-8 text-dark">{{ $data->proposal_name }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4 text-end fw-bold">Ngày tạo:</div>
                                            <div class="col-sm-8 text-dark">
                                                {{ $data->created_at->format('d-m-Y') }}
                                            </div>
                                        </div>
                                        @if ($data->from_date)
                                            <div class="row mb-3">
                                                <div class="col-sm-4 text-end fw-bold">Từ Ngày:</div>
                                                <div class="col-sm-8 text-dark">
                                                    {{ $data->from_date ? $data->from_date : '' }}
                                                </div>
                                            </div>
                                        @endif
                                        @if ($data->to_date)
                                            <div class="row mb-3">
                                                <div class="col-sm-4 text-end fw-bold">Đến Ngày:</div>
                                                <div class="col-sm-8 text-dark">
                                                    {{ $data->to_date ? $data->to_date : '' }}
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row mb-3">
                                            <div class="col-sm-4 text-end fw-bold">Nội dung:</div>
                                            <div class="col-sm-8 text-dark">{{ $data->content }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4 text-end fw-bold">Người tạo:</div>
                                            <div class="col-sm-8 text-dark">{{ $data->user->name ?? 'N/A' }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4 text-end fw-bold">Người duyệt:</div>
                                            <div class="col-sm-8 text-dark">
                                                {{ $data->reviewer->name ?? 'Chưa chỉ định' }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-4 text-end fw-bold">Trạng thái:</div>
                                            <div class="col-sm-8">
                                                <span class="badge 
                                                        @if ($data->status === 'Gửi') bg-warning 
                                                        @elseif($data->status === 'Chấp Nhận') bg-success 
                                                        @elseif($data->status === 'Từ chối') bg-danger 
                                                        @else bg-secondary @endif">
                                                    {{ $data->status }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Hiển thị tệp đính kèm nếu có -->
                                        @if (!empty($data->attachments))
                                            <div class="row mb-3">
                                                <div class="col-sm-4 text-end fw-bold">Tệp đính kèm:</div>
                                                <div class="col-sm-8">
                                                    @foreach ($data->attachments as $attachment)
                                                        <p>{{ $attachment->file_name }}</p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer bg-light">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>