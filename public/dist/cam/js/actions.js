
// Location
$(document).on('click', '.editLocation', function() {
    var id = $('#editLocation').val($(this).data("location"));
    var location = $('#editId').val($(this).data('id'));
});

// Date
$(document).on('click', '.editDate', function() {
    var id = $('#editDateId').val($(this).data("id"));
    var date = $('#editDate').val($(this).data('start_date'));
});

// findings
$(document).on('click', '.editFindings', function() {
    var id = $('#editFindingsId').val($(this).data("id"));
    var findings = $('#editFindings').val($(this).data('findings'));
});

// Protective Corrective Action
$(document).on('click', '.editPca', function() {
    var id = $('#editPcaId').val($(this).data("id"));
    var pca = $('#editPca').val($(this).data('pca'));
});

// Accountability
$(document).on('click', '.editAccountability', function() {
    var id = $('#editAccountabilityId').val($(this).data("id"));
    var accountability = $('#editAccountability').val($(this).data('accountability'));
});

// Status
$(document).on('click', '.editStatus', function() {
    var id = $('#editStatusId').val($(this).data("id"));
    var status = $('#editStatus').val($(this).data('status'));
});

// Closing Date
$(document).on('click', '.editClosingDate', function() {
    var id = $('#editClosingDateId').val($(this).data("id"));
    var status = $('#editClosingDate').val($(this).data('closing_date'));
});