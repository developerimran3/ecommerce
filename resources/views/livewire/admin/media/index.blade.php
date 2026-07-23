<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4><i class="fas fa-photo-video"></i> Media Library</h4>
        <button class="btn btn-purple" data-toggle="modal" data-target="#uploadModal">
            <i class="fas fa-cloud-upload-alt"></i> Add New Media
        </button>
    </div>

    <div class="d-flex justify-content-between mb-3">
        <div class="btn-group">
            <button class="btn btn-light active">All</button>
            <button class="btn btn-light">Images</button>
            <button class="btn btn-light">Videos</button>
        </div>
        <small class="text-muted">Showing 1-12 of 245 items</small>
    </div>

    <div class="row" id="mediaGrid">
        <!-- Demo Images -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="media-item" onclick="toggleSelect(this)">
                <img src="https://picsum.photos/id/1015/600/400" class="media-img" alt="">
                <div class="delete-btn" onclick="event.stopImmediatePropagation(); deleteMedia(this)"><i
                        class="fas fa-times"></i></div>
                <div class="tick-mark"><i class="fas fa-check"></i></div>
            </div>
            <small class="d-block text-center mt-2 text-muted">hero-banner.jpg</small>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="media-item" onclick="toggleSelect(this)">
                <img src="https://picsum.photos/id/201/600/400" class="media-img" alt="">
                <div class="delete-btn" onclick="event.stopImmediatePropagation(); deleteMedia(this)"><i
                        class="fas fa-times"></i></div>
                <div class="tick-mark"><i class="fas fa-check"></i></div>
            </div>
            <small class="d-block text-center mt-2 text-muted">product-01.png</small>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="media-item" onclick="toggleSelect(this)">
                <img src="https://picsum.photos/id/237/600/400" class="media-img" alt="">
                <div class="delete-btn" onclick="event.stopImmediatePropagation(); deleteMedia(this)"><i
                        class="fas fa-times"></i></div>
                <div class="tick-mark"><i class="fas fa-check"></i></div>
            </div>
            <small class="d-block text-center mt-2 text-muted">nature.jpg</small>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="media-item" onclick="toggleSelect(this)">
                <img src="https://picsum.photos/id/301/600/400" class="media-img" alt="">
                <div class="delete-btn" onclick="event.stopImmediatePropagation(); deleteMedia(this)"><i
                        class="fas fa-times"></i></div>
                <div class="tick-mark"><i class="fas fa-check"></i></div>
            </div>
            <small class="d-block text-center mt-2 text-muted">fashion.jpg</small>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="media-item" onclick="toggleSelect(this)">
                <img src="https://picsum.photos/id/401/600/400" class="media-img" alt="">
                <div class="delete-btn" onclick="event.stopImmediatePropagation(); deleteMedia(this)"><i
                        class="fas fa-times"></i></div>
                <div class="tick-mark"><i class="fas fa-check"></i></div>
            </div>
            <small class="d-block text-center mt-2 text-muted">tech.jpg</small>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="media-item" onclick="toggleSelect(this)">
                <img src="https://picsum.photos/id/870/600/400" class="media-img" alt="">
                <div class="delete-btn" onclick="event.stopImmediatePropagation(); deleteMedia(this)"><i
                        class="fas fa-times"></i></div>
                <div class="tick-mark"><i class="fas fa-check"></i></div>
            </div>
            <small class="d-block text-center mt-2 text-muted">food.jpg</small>
        </div>
    </div>
    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Upload Media Files</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="upload-zone text-center p-5 mb-3"
                        onclick="document.getElementById('fileInput').click()">
                        <i class="fas fa-cloud-upload-alt fa-4x text-primary mb-3"></i>
                        <h5>Drop files here or click to upload</h5>
                        <small class="text-muted">Multiple images supported</small>
                    </div>
                    <input type="file" id="fileInput" multiple accept="image/*" class="d-none"
                        onchange="previewFiles(event)" />

                    <div id="previewContainer" class="preview-container"></div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-success" onclick="uploadFiles()">
                        Upload All
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
