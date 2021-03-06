<html>

<head>
    <meta charset="utf-8">
    <title>Hey</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/document-card.css">
    <link rel="stylesheet" href="css/document-input.css">
    <link rel="stylesheet" href="css/document-filter.css">
    <script src="js/main.js"></script>
</head>

<body class=bg-dark>
    <div class="card document-input bg-light">
        <form enctype="multipart/form-data" id="new-document-form" action="php/new_document_handler.php" method="post">
            <div class="form-group row">
                <label for="document-author" class="col-sm-2 col-form-label">Author</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-document-author" name="input-document-author" placeholder="Jane Doe" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="document-type" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-document-type" name="input-document-type" placeholder="Accounting" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="document-file-input" class="col-sm-2 col-form-label">Document</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="input-document-file" name="input-document-file" required>
                </div>
            </div>
        </form>
    </div>

    <div class="document-filter">
        <div id="type-dropdown" class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="type-dropdown-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Document Type
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"></div>
        </div>

        <div id="extension-dropdown" class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="extension-dropdown-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Document Extension
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"></div>
        </div>

        <button type="submit" class="btn btn-primary" form="new-document-form">Submit</button>
    </div>

    <div class="modal fade" id="editDocumentModal" tabindex="-1" role="dialog" aria-labelledby="editDocumentModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDocumentModalTitle">Edit Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-document-form" enctype="multipart/form-data" action="php/update_document_handler.php" method="post">
                        <input type="hidden" id="input-edit-document-id" name="input-edit-document-id" required>
                        <div class="form-group row">
                            <label for="input-document-author" class="col-sm-2 col-form-label">Author</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-edit-document-author" name="input-edit-document-author" placeholder="Jane Doe" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-document-type" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-edit-document-type" name="input-edit-document-type" placeholder="Accounting" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-document-file" class="col-sm-2 col-form-label">Document</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control-file" id="input-edit-document-file" name="input-edit-document-file" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="document-edit-submit-button" type="submit" class="btn btn-sm btn-primary" data-dismiss="modal">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <template id="document-card-template">
        <div class="card document-card bg-light">
            <div class="document-card-column document-information">
                <div class="text-left document-title text-wrap"></div>
                <div class="text-left text-muted document-author"></div>
            </div>
            <div class="document-card-column document-meta">
                <div class="text-center document-type"></div>
                <div class="text-center text-muted document-format"></div>
            </div>
            <div class="document-card-column document-actions">
                <button class="btn document-download">
                    <svg class="bi bi-cloud-download" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.887 5.2l-.964-.165A2.5 2.5 0 103.5 10H6v1H3.5a3.5 3.5 0 11.59-6.95 5.002 5.002 0 119.804 1.98A2.501 2.501 0 0113.5 11H10v-1h3.5a1.5 1.5 0 00.237-2.981L12.7 6.854l.216-1.028a4 4 0 10-7.843-1.587l-.185.96z" />
                        <path fill-rule="evenodd" d="M5 12.5a.5.5 0 01.707 0L8 14.793l2.293-2.293a.5.5 0 11.707.707l-2.646 2.646a.5.5 0 01-.708 0L5 13.207a.5.5 0 010-.707z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M8 6a.5.5 0 01.5.5v8a.5.5 0 01-1 0v-8A.5.5 0 018 6z" clip-rule="evenodd" />
                    </svg>
                </button>
                <button class="btn document-delete">
                    <svg class="bi bi-trash" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd" />
                    </svg>
                </button>
                <button class="btn document-edit" data-toggle="modal" data-target="#editDocumentModal">
                    <svg class="bi bi-pencil" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </template>
</body>

</html>