<div class="row">
    <div class="col-lg-12">
        <div id="notification" class="alert alert-success mt-1">Link copied to clipboard!</div>
        {{ Form::model($lead, ['route' => ['lead.sendemailpdf', urlencode(encrypt($lead->id))], 'method' => 'POST','enctype'=>'multipart/form-data']) }}

        <div class="">
            <dl class="row">
                <input type="hidden" name="lead" value="{{ $lead->id }}">
                <dt class="col-md-6"><span class="h6  mb-0">{{__('Name')}}</span></dt>
                <dd class="col-md-6">
                    <input type="text" name="name" class="form-control" value="{{ $lead->name }}" readonly>
                </dd>

                <dt class="col-md-6"><span class="h6  mb-0">{{__('Recipient')}}</span></dt>
                <dd class="col-md-6">
                    <input type="email" name="email" class="form-control" value="{{ $lead->email }}" required>
                </dd>

                <dt class="col-md-12"><span class="h6  mb-0">{{__('Subject')}}</span></dt>
                <dd class="col-md-12"><input type="text" name="subject" id="Subject" class="form-control" required></dd>

                <dt class="col-md-12"><span class="h6  mb-0">{{__('Content')}}</span></dt>
                <dd class="col-md-12"><textarea name="emailbody" id="emailbody" cols="30" rows="10" class="form-control" required></textarea></dd>

                <dt class="col-md-12"><span class="h6  mb-0">{{__('Upload Document')}}</span></dt>
                <dd class="col-md-12"><input type="file" name="attachment" id="attachment" class="form-control"></dd>
            </dl>
        </div>
        <div class="modal-footer">
            {{ Form::button(__('Send') . ' <i class="fas fa-paper-plane"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
    </div>
    {{Form::close()}}
</div>

<style>
    #notification {
        display: none;
    }
</style>
<script>
    function copyToClipboard(text) {
        /* Create a temporary input element */
        var tempInput = document.createElement("input");

        /* Set the value of the input element to the text to be copied */
        tempInput.value = text;

        document.body.appendChild(tempInput);

        /* Select the text in the input element */
        tempInput.select();

        /* Copy the selected text to the clipboard */
        document.execCommand("copy");

        /* Remove the temporary input element from the DOM */
        document.body.removeChild(tempInput);
        showNotification();

        /* Hide the notification after 2 seconds (adjust as needed) */
        setTimeout(hideNotification, 2000);
    }

    function showNotification() {
        var notification = document.getElementById('notification');
        notification.style.display = 'block';
    }

    function hideNotification() {
        var notification = document.getElementById('notification');
        notification.style.display = 'none';
    }
</script>