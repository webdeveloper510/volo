<style>
    .document-heading {
        text-decoration: underline;
    }

    .document-input {
        border: 0;
        outline: 0;
        background: transparent;
        border-bottom: 1px solid black;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div id="notification" class="alert alert-success mt-1">Link copied to clipboard!</div>
        <?php echo e(Form::model($lead, ['route' => ['lead.pdf', urlencode(encrypt($lead->id))], 'method' => 'POST','enctype'=>'multipart/form-data'])); ?>


        <div class="">
            <dl class="row">
                <input type="hidden" name="lead" value="<?php echo e($lead->id); ?>">
                <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Name')); ?></span></dt>
                <dd class="col-md-6">
                    <input type="text" name="name" class="form-control" value="<?php echo e($lead->name); ?>" readonly>
                </dd>

                <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Recipient')); ?></span></dt>
                <dd class="col-md-6">
                    <input type="email" name="email" class="form-control" value="<?php echo e($lead->email); ?>" required>
                </dd>

                <dt class="col-md-12"><span class="h6  mb-0"><?php echo e(__('Subject')); ?></span></dt>
                <dd class="col-md-12"><input type="text" name="subject" id="Subject" class="form-control" required></dd>

                <dt class="col-md-12"><span class="h6  mb-0"><?php echo e(__('Content')); ?></span></dt>
                <dd class="col-md-12"><textarea name="emailbody" id="emailbody" cols="30" rows="10" class="form-control" required></textarea></dd>

                <dt class="col-md-12"><span class="h6  mb-0"><?php echo e(__('Upload Document')); ?></span></dt>
                <dd class="col-md-12"><input type="file" name="attachment" id="attachment" class="form-control"></dd>
            </dl>
            <hr class="mt-4 mb-4">

            <!-- NDA code start here -->
            <h3 style="text-align: center;">NON-DISCLOSURE AGREEMENT</h3>
            THIS AGREEMENT (the "Agreement”) is entered into on this <input class="document-input" type="text" name="aggrement_day" value="" />day of <input class="document-input" type="text" name="aggrement_by" value="" />by and
            between VoloFleet, LLC & VoloFleet Logistics Holdings Corporation, (the” Disclosing Party”), and <input class="document-input" type="text" name="aggrement_receiving_party" value="" /> (the “Receiving Party”).

            The Receiving Party hereto desires to participate in discussions regarding <input class="document-input" type="text" name="aggrement_transaction" value="" /> (the “Transaction”). During these discussions, Disclosing Party may share certain proprietary information with the Receiving Party. Therefore, in consideration of the mutual promises and covenants contained in this Agreement, and other good and valuable consideration, the receipt and sufficiency of which is hereby acknowledged, the parties hereto agree as follows:
            <h4 class="mt-3">1. <span class="document-heading">Definition of Confidential Information</span></h4>
            <p>(a) For purposes of this Agreement “Confidential Information” means any data or information that is proprietary to the Disclosing Party and not generally known to the public whether in tangible or intangible form in whatever medium provided whether unmodified or modified by Receiving Party or its Representatives (as defined herein) whenever and however disclosed including but not limited to: (i) any marketing strategies plans financial information or projections operations sales estimates business plans and performance results relating to the past present or future business activities of such party its affiliates subsidiaries and affiliated companies; (ii) plans for products or services and customer or supplier lists; (iii) any scientific or technical information invention design process procedure formula improvement technology or method; (iv) any concepts reports data know-how works-in-progress designs development tools specifications computer software source code object code flow charts databases inventions information and trade secrets; (v) any other information that should reasonably be recognized as confidential information of the Disclosing Party; and (vi) any information generated by the Receiving Party or by its Representatives that contains reflects or is derived from any of the foregoing. Confidential Information need not be novel unique patentable copyrightable or constitute a trade secret in order to be designated Confidential Information. The Receiving Party acknowledges that the Confidential Information is proprietary to the Disclosing Party has been developed and obtained through great efforts by the Disclosing Party and that Disclosing Party regards all of its Confidential Information as trade secrets.</p>
            <p>(b) Notwithstanding anything in the foregoing to the contrary Confidential Information shall not include information which: a) was lawfully possessed as evidenced by the Receiving Party’s records by the Receiving Party prior to receiving the Confidential Information from the Disclosing Party; (b) becomes rightfully known by the Receiving Party from a third-party source not under an obligation to Disclosing Party to maintain confidentiality; (c) is generally known by the public through no fault of or failure to act by the Receiving Party inconsistent with its obligations under this Agreement; (d) is required to be disclosed in a judicial or administrative proceeding or is otherwise requested or required to be disclosed by law or regulation although the requirements of paragraph 4 hereof shall apply prior to any disclosure being made; and (e) is or has been independently developed by employees consultants or agents of the Receiving Party without violation of the terms of this Agreement as evidenced by the Receiving Party’s records and without reference or access to any Confidential Information.</p>

            <h4>2. <span class="document-heading">Disclosure of Confidential Information</span></h4>
            <p>From time to time the Disclosing Party may disclose Confidential Information to the Receiving Party. The Receiving Party will: (a) limit disclosure of any Confidential Information to its directors officers employees agents or representatives (collectively “Representatives”) who have a need to know such Confidential Information in connection with the current or contemplated business relationship between the parties to which this Agreement relates and only for that purpose; (b) advise its Representatives of the proprietary nature of the Confidential Information and of the obligations set forth in this Agreement require such Representatives to be bound by written confidentiality restrictions no less stringent than those contained herein and assume full liability for acts or omissions by its Representatives that are inconsistent with its obligations under this Agreement; (c) keep all Confidential Information strictly confidential by using a reasonable degree of care but not less than the degree of care used by it in safeguarding its own confidential information; and (d) not disclose any Confidential Information received by it to any third parties (except as otherwise provided for herein).</p>

            <h4>3. <span class="document-heading">Use of Confidential Information</span></h4>
            <p>The Receiving Party agrees to use the Confidential Information solely in connection with the current or contemplated business relationship between the parties and not for any purpose other than as authorized by this Agreement without the prior written consent of an authorized representative of the Disclosing Party. No other right or license whether expressed or implied in the Confidential Information is granted to the Receiving Party hereunder. Title to the Confidential Information will remain solely in the Disclosing Party. All use of Confidential Information by the Receiving Party shall be for the benefit of the Disclosing Party and any modifications and improvements thereof by the Receiving Party shall be the sole property of the Disclosing Party.</p>

            <h4>4. <span class="document-heading">Compelled Disclosure of Confidential Information</span></h4>
            <p>Notwithstanding anything in the foregoing to the contrary the Receiving Party may disclose Confidential Information pursuant to any governmental judicial or administrative order subpoena discovery request regulatory request or similar method provided that the Receiving Party promptly notifies to the extent practicable the Disclosing Party in writing of such demand for disclosure so that the Disclosing Party at its sole expense may seek to make such disclosure subject to a protective order or other appropriate remedy to preserve the confidentiality of the Confidential Information; provided that the Receiving Party will disclose only that portion of the requested Confidential Information that in the written opinion of its legal counsel it is required to disclose. The Receiving Party agrees that it shall not oppose and shall cooperate with efforts by to the extent practicable the Disclosing Party with respect to any such request for a protective order or other relief. Notwithstanding the foregoing if the Disclosing Party is unable to obtain or does not seek a protective order and the Receiving Party is legally requested or required to disclose such Confidential Information disclosure of such Confidential Information may be made without liability.</p>

            <h4>5. <span class="document-heading">Term</span></h4>
            <p>This Agreement shall remain in effect for a two-year term (subject to a one-year extension if the parties are still discussing and considering the Transaction at the end of the second year). Notwithstanding the foregoing the Receiving Party’s duty to hold in confidence Confidential Information that was disclosed during term shall remain in effect indefinitely.</p>

            <h4>6. <span class="document-heading">Remedies</span></h4>
            <p>Both parties acknowledge that the Confidential Information to be disclosed hereunder is of a unique and valuable character and that the unauthorized dissemination of the Confidential Information would destroy or diminish the value of such information. The damages to Disclosing Party that would result from the unauthorized dissemination of the Confidential Information would be impossible to calculate. Therefore both parties hereby agree that the Disclosing Party shall be entitled to injunctive relief preventing the dissemination of any Confidential Information in violation of the terms hereof. Such injunctive relief shall be in addition to any other remedies available hereunder whether at law or in equity. Disclosing Party shall be entitled to recover its costs and fees including reasonable attorneys’ fees incurred in obtaining any such relief. Further in the event of litigation relating to this Agreement the prevailing party shall be entitled to recover its reasonable attorney’s fees and expenses.</p>

            <h4>7. <span class="document-heading">Return of Confidential Information</span></h4>
            <p>Receiving Party shall immediately return and redeliver to Disclosing Party all tangible material embodying any Confidential Information provided hereunder and all notes summaries memoranda drawings manuals records excerpts or derivative information deriving therefrom and all other documents or materials (“Notes”) (and all copies of any of the foregoing including “copies” that have been converted to computerized media in the form of image data word processing or other types of files either manually or by image capture) based on or including any Confidential Information in whatever form of storage or retrieval upon the earlier of (i) the completion or termination of the dealings between the parties contemplated hereunder; (ii) the termination of this Agreement; or (iii) at such time as the Disclosing Party may so request; provided however that the Receiving Party may retain such of its documents as is necessary to enable it to comply with its reasonable document retention policies. Alternatively the Receiving Party with the written consent of the Disclosing Party may (or in the case of Notes at the Receiving Party’s option) immediately destroy any of the foregoing embodying Confidential Information (or the reasonably nonrecoverable data erasure of computerized data) and upon request certify in writing such destruction by an authorized officer of the Receiving Party supervising the destruction).</p>

            <h4>8. <span class="document-heading">Notice of Breach</span></h4>
            <p>Receiving Party shall notify the Disclosing Party immediately upon discovery of or suspicion of (1) any unauthorized use or disclosure of Confidential Information by Receiving Party or its Representatives; or (2) any actions by Receiving Party or its Representatives inconsistent with their respective obligations under this Agreement Receiving Party shall cooperate with any and all efforts of the Disclosing Party to help the Disclosing Party regain possession of Confidential Information and prevent its further unauthorized use.</p>

            <h4>9. <span class="document-heading">No Binding Agreement for Transaction</span></h4>
            <p>The parties agree that neither party will be under any legal obligation of any kind whatsoever with respect to a Transaction by virtue of this Agreement, except for the matters specifically agreed to herein. The parties further acknowledge and agree that they each reserve the right, in their sole and absolute discretion, to reject any and all proposals and to terminate discussions and negotiations with respect to a Transaction at any time. This Agreement does not create a joint venture or partnership between the parties. If a Transaction goes forward, the non-disclosure provisions of any applicable transaction documents entered into between the parties (or their respective affiliates) for the Transaction shall supersede this Agreement. In the event such provision is not provided for in said transaction documents, this Agreement shall control.</p>

            <h4>10. <span class="document-heading">Warranty</span></h4>
            <p>NO WARRANTIES ARE MADE BY EITHER PARTY UNDER THIS AGREEMENT WHATSOEVER. The parties acknowledge that although they shall each endeavor to include in the Confidential Information all information that they each believe relevant for the purpose of the evaluation of a Transaction, the parties understand that no representation or warranty as to the accuracy or completeness of the Confidential Information is being made by the Disclosing Party. Further, neither party is under any obligation under this Agreement to disclose any Confidential Information it chooses not to disclose. The Disclosing Party shall have no liability to the Receiving Party (or any other person or entity) resulting from the use of the Disclosing Party's Confidential Information or any reliance on the accuracy or completeness thereof.</p>

            <h4>11. <span class="document-heading">Miscellaneous</span></h4>
            <p>(a) This Agreement constitutes the entire understanding between the parties and supersedes any and all prior or contemporaneous understandings and agreements, whether oral or written, between the parties, with respect to the subject matter hereof. This Agreement can only be modified by a written amendment signed by the party against whom enforcement of such modification is sought.</p>
            <p>(b) The validity, construction and performance of this Agreement shall be governed and construed in accordance with the laws of New York (state) applicable to contracts made and to be wholly performed within such state, without giving effect to any conflict of laws provisions thereof. The Federal and state courts located in New York (state) shall have sole and exclusive jurisdiction over any disputes arising under, or in any way connected with or related to, the terms of this Agreement and Receiving Party: (i) consents to personal jurisdiction therein; and (ii) waives the right to raise forum non conveniens or any similar objection.</p>
            <p>(c) Any failure by either party to enforce the other party’s strict performance of any provision of this Agreement will not constitute a waiver of its right to subsequently enforce such provision or any other provision of this Agreement.</p>
            <p>(d) Although the restrictions contained in this Agreement are considered by the parties to be reasonable for the purpose of protecting the Confidential Information, if any such restriction is found by a court of competent jurisdiction to be unenforceable, such provision will be modified, rewritten or interpreted to include as much of its nature and scope as will render it enforceable. If it cannot be so modified, rewritten or interpreted to be enforceable in any respect, it will not be given effect, and the remainder of the Agreement will be enforced as if such provision was not included.</p>
            <p>(e) Any notices or communications required or permitted to be given hereunder may be delivered by hand, deposited with a nationally recognized overnight carrier, electronic-mail, or mailed by certified mail, return receipt requested, postage prepaid, in each case, to the address of the other party first indicated above (or such other addressee as may be furnished by a party in accordance with this paragraph). All such notices or communications shall be deemed to have been given and received (a) in the case of personal delivery or electronic-mail, on the date of such delivery, (b) in the case of delivery by a nationally recognized overnight carrier, on the third business day following dispatch and (c) in the case of mailing, on the seventh business day following such mailing.</p>
            <p>(f) This Agreement is personal in nature, and neither party may directly or indirectly assign or transfer it by operation of law or otherwise without the prior written consent of the other party, which consent will not be unreasonably withheld. All obligations contained in this Agreement shall extend to and be binding upon the parties to this Agreement and their respective successors, assigns and designees.</p>
            <p>(g) The receipt of Confidential Information pursuant to this Agreement will not prevent or in any way limit either party from: (i) developing, making or marketing products or services that are or may be competitive with the products or services of the other; or (ii) providing products or services to others who compete with the other.</p>
            <p>(h) Paragraph headings used in this Agreement are for reference only and shall not be used or relied upon in the interpretation of this Agreement.</p>
            <p><b>IN WITNESS WHEREOF</b>, the parties hereto have executed this Agreement as of the date first above written.</p>

            <div class="row">
                <div class="col-6">
                    <h4>Disclosing Party </h4>
                    <p>By <input class="document-input" type="text" name="disclosing_by" value="VOLO" /></p>
                    <p>Name <input class="document-input" type="text" name="disclosing_party_name" value="<?php echo e($lead->name); ?>" /></p>
                    <p>Title <input class="document-input" type="text" name="disclosing_party_title" value="NDA" /></p>
                </div>

                <div class="col-6">
                    <h4>Receiving Party</h4>
                    <p>By <input class="document-input" type="text" name="receiving_by" value="" /></p>
                    <p>Name <input class="document-input" type="text" name="receiving_party_name" value="" /></p>
                    <p>Title <input class="document-input" type="text" name="receiving_party_title" value="" /></p>
                </div>
            </div>
            <!-- NDA code end here -->
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-toggle="tooltip" onclick="getDataUrlAndCopy(this)" data-url="<?php echo e(route('lead.signednda',urlencode(encrypt($lead->id)))); ?>" title='Copy To Clipboard'>
                <i class="ti ti-copy"></i>
            </button>
            <?php echo e(Form::submit(__('Share via mail'),array('class'=>'btn btn-primary'))); ?>

        </div>

    </div>
    <?php echo e(Form::close()); ?>

</div>

<style>
    #notification {
        display: none;
    }
</style>
<script>
    // function getDataUrlAndCopy(button) {
    //     var dataUrl = button.getAttribute('data-url');
    //     copyToClipboard(dataUrl);
    // }

    function getDataUrlAndCopy(button) {
        // Collect input values
        var agreementDay = document.querySelector('input[name="aggrement_day"]').value;
        var agreementBy = document.querySelector('input[name="aggrement_by"]').value;
        var receivingParty = document.querySelector('input[name="aggrement_receiving_party"]').value;
        var transaction = document.querySelector('input[name="aggrement_transaction"]').value;
        var disclosing_by = document.querySelector('input[name="disclosing_by"]').value;
        var disclosing_party_name = document.querySelector('input[name="disclosing_party_name"]').value;
        var disclosing_party_title = document.querySelector('input[name="disclosing_party_title"]').value;

        // Encrypt the values (here using Base64 for demonstration)
        var encryptedDay = btoa(agreementDay);
        var encryptedBy = btoa(agreementBy);
        var encryptedReceivingParty = btoa(receivingParty);
        var encryptedTransaction = btoa(transaction);
        var encryptedDisclosing_by = btoa(disclosing_by);
        var encryptedDisclosing_party_name = btoa(disclosing_party_name);
        var encryptedDisclosing_party_title = btoa(disclosing_party_title);

        // Update the data-url with encrypted values
        var dataUrl = button.getAttribute('data-url');
        dataUrl += `?day=${encodeURIComponent(encryptedDay)}&by=${encodeURIComponent(encryptedBy)}&rec_p=${encodeURIComponent(encryptedReceivingParty)}&tran=${encodeURIComponent(encryptedTransaction)}&disc_b=${encodeURIComponent(encryptedDisclosing_by)}&disc_p_n=${encodeURIComponent(encryptedDisclosing_party_name)}&disc_p_t=${encodeURIComponent(encryptedDisclosing_party_title)}`;

        // Copy the updated URL to clipboard
        copyToClipboard(dataUrl);
    }

    function copyToClipboard(text) {
        /* Create a temporary input element */
        var tempInput = document.createElement("input");
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();

        document.execCommand("copy");
        document.body.removeChild(tempInput);
        showNotification();

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
</script><?php /**PATH C:\xampp\htdocs\volo\resources\views/lead/nda_sign.blade.php ENDPATH**/ ?>