{{-- File Uploads Alert Box --}}
<div class="alert alert-info mt-5">
    <p>Application Requirements (Scanned File or Photo)</p>
    <p>Please upload the following documents:</p>
    <ul>
        <li>SF-9 or Form 138 Report Card (FRONT VIEW)</li>
        <li>SF-9 or Form 138 Report Card (BACK VIEW)</li>
        <li>GWA Certification</li>
        <li>Good Moral Character</li>
        <li>PSA Birth Certificate (NSO)</li>
        <li>Medical Certificate</li>
        <li>Honorable Dismissal (Transferees)</li>
    </ul>
    <p>Capture Applicant's Selfie</p>
</div>
{{-- File Upload Inputs --}}
<div class="row">
    <div class="col-12 form-group inputDnD">
        <input type="file" class="form-control-file" id="med-cert" name="med-cert" onchange="readUrl(this)" data-title="Click this to upload Medical Certificate">
    </div>
    <div class="col-12 form-group inputDnD">
        <input type="file" class="form-control-file" id="gmc" name="gmc" onchange="readUrl(this)" data-title="Click this to upload Good Moral Character">
    </div>
    <div class="col-12 form-group inputDnD">
        <input type="file" class="form-control-file" id="sf9-f" name="sf9-front" onchange="readUrl(this)" data-title="Click this to upload SF-9 or Form 138 [FRONT VIEW]">
    </div>
    <div class="col-12 form-group inputDnD">
        <input type="file" class="form-control-file" id="sf9-b" name="sf9-back" onchange="readUrl(this)" data-title="Click this to upload SF-9 or Form 138 [BACK VIEW]">
    </div>
    <div class="col-12 form-group inputDnD">
        <input type="file" class="form-control-file" id="gwa" name="gwa" onchange="readUrl(this)" data-title="Click this to upload General Weighted Average">
    </div>
    <div class="col-12 form-group inputDnD">
        <input type="file" class="form-control-file" id="psa-bc" name="psa-bc" onchange="readUrl(this)" data-title="Click this to upload PSA Birth Certificate [NSO]">
    </div>
    <div class="col-12 form-group inputDnD">
        <input type="file" class="form-control-file" id="hon-d" name="hd" onchange="readUrl(this)" data-title="Click this to upload Honorable Dismissal">
    </div>
</div>