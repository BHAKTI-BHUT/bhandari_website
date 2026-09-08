<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Refund Management | Admin Panel</title>
<meta name="description" content="Admin panel to manage booking cancellation and refund requests." />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Inter', sans-serif; background: #f4f6fb; color: #1a1d2e; }

  .adm-topbar {
    background: linear-gradient(135deg, #FC5D09 0%, #7b0d0d 100%);
    padding: 18px 32px;
    display: flex;
    align-items: center;
    gap: 18px;
    box-shadow: 0 4px 20px rgba(252, 93, 9,.35);
  }
  .adm-topbar h1 { color: #fff; font-size: 1.4rem; font-weight: 800; letter-spacing: .5px; }
  .adm-topbar .badge-count {
    background: rgba(255,255,255,.2);
    color: #fff;
    border-radius: 20px;
    padding: 3px 14px;
    font-size: .85rem;
    font-weight: 700;
  }

  .flash-msg {
    margin: 16px 32px 0;
    padding: 14px 20px;
    border-radius: 10px;
    font-size: .9rem;
    font-weight: 600;
    background: #e8f5e9;
    color: #2e7d32;
    border-left: 5px solid #43a047;
  }

  .stats-row {
    display: flex;
    gap: 16px;
    padding: 20px 32px;
    flex-wrap: wrap;
  }
  .stat-card {
    background: #fff;
    border-radius: 12px;
    padding: 16px 22px;
    flex: 1;
    min-width: 140px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    border-top: 4px solid #FC5D09;
    text-align: center;
  }
  .stat-card.blue  { border-top-color: #1976d2; }
  .stat-card.green { border-top-color: #43a047; }
  .stat-card.amber { border-top-color: #f57c00; }
  .stat-card.gray  { border-top-color: #757575; }
  .stat-val { font-size: 2rem; font-weight: 800; color: #1a1d2e; }
  .stat-lbl { font-size: .78rem; color: #888; font-weight: 600; margin-top: 4px; text-transform: uppercase; letter-spacing: .4px; }

  .adm-toolbar {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    padding: 0 32px 16px;
    align-items: center;
  }
  .adm-toolbar select, .adm-toolbar input {
    padding: 9px 16px;
    border: 1.5px solid #e0e4ef;
    border-radius: 8px;
    font-size: .88rem;
    font-family: 'Inter', sans-serif;
    outline: none;
    background: #fff;
  }
  .adm-toolbar select:focus, .adm-toolbar input:focus { border-color: #FC5D09; }
  .adm-toolbar .filter-label { font-size: .82rem; color: #666; font-weight: 600; }
  .btn-export {
    margin-left: auto;
    background: #1a1d2e;
    color: #fff;
    padding: 9px 20px;
    border-radius: 8px;
    border: none;
    font-size: .85rem;
    font-weight: 600;
    cursor: pointer;
  }
  .btn-export:hover { background: #FC5D09; }

  .table-wrap {
    margin: 0 32px 40px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 18px rgba(0,0,0,.06);
    overflow: hidden;
  }
  table { width: 100%; border-collapse: collapse; }
  thead tr { background: #1a1d2e; }
  thead th {
    padding: 14px 16px;
    color: #fff;
    font-size: .8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    white-space: nowrap;
    text-align: left;
  }
  tbody tr { border-bottom: 1px solid #f0f0f0; }
  tbody tr:hover { background: #fafbff; }
  tbody td { padding: 13px 16px; font-size: .87rem; vertical-align: middle; }
  .no-records { text-align: center; padding: 60px 20px; color: #bbb; font-size: 1rem; }

  .badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: .75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .4px;
  }
  .badge-pending    { background: #fff8e1; color: #f57f17; }
  .badge-approved   { background: #e3f2fd; color: #1565c0; }
  .badge-processing { background: #e8eaf6; color: #3949ab; }
  .badge-refunded   { background: #e8f5e9; color: #2e7d32; }
  .badge-rejected   { background: #ffebee; color: #c62828; }

  .pt-advance { color: #6a1b9a; font-weight: 700; font-size: .8rem; }
  .pt-final   { color: #00695c; font-weight: 700; font-size: .8rem; }
  .pt-full    { color: #bf360c; font-weight: 700; font-size: .8rem; }

  .action-btns { display: flex; gap: 6px; flex-wrap: wrap; }
  .btn-sm {
    padding: 6px 14px;
    border-radius: 6px;
    border: none;
    font-size: .78rem;
    font-weight: 700;
    cursor: pointer;
    transition: all .18s;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .btn-approve { background: #e3f2fd; color: #1565c0; }
  .btn-approve:hover { background: #1565c0; color: #fff; }
  .btn-refund  { background: #e8f5e9; color: #2e7d32; }
  .btn-refund:hover  { background: #2e7d32; color: #fff; }
  .btn-reject  { background: #ffebee; color: #c62828; }
  .btn-reject:hover  { background: #c62828; color: #fff; }
  .btn-view    { background: #f3e5f5; color: #6a1b9a; }
  .btn-view:hover    { background: #6a1b9a; color: #fff; }
  .btn-done    { background: #eee; color: #888; cursor: default; font-size: .75rem; }

  .amount-col { font-weight: 700; }
  .amount-approved { color: #2e7d32; font-weight: 700; }

  /* Modal */
  .modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.52);
    z-index: 9999;
    align-items: center;
    justify-content: center;
  }
  .modal-overlay.show { display: flex; }
  .modal-box {
    background: #fff;
    border-radius: 16px;
    width: 94%;
    max-width: 580px;
    box-shadow: 0 20px 60px rgba(0,0,0,.25);
    overflow: hidden;
  }
  .modal-head {
    background: linear-gradient(135deg, #FC5D09, #7b0d0d);
    color: #fff;
    padding: 20px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .modal-head h3 { font-size: 1.1rem; font-weight: 800; }
  .modal-close { background: none; border: none; color: #fff; font-size: 1.6rem; cursor: pointer; line-height:1; }
  .modal-body { padding: 24px; }
  .modal-field { margin-bottom: 16px; }
  .modal-field label { display: block; font-size: .83rem; font-weight: 700; color: #555; margin-bottom: 6px; }
  .modal-field input, .modal-field textarea {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid #e0e4ef;
    border-radius: 8px;
    font-size: .9rem;
    font-family: 'Inter', sans-serif;
    outline: none;
    background: #fafafa;
  }
  .modal-field input:focus, .modal-field textarea:focus { border-color: #FC5D09; background: #fff; }
  .modal-field .info-text { font-size: .78rem; color: #888; margin-top: 4px; }
  .modal-foot {
    padding: 16px 24px;
    border-top: 1px solid #f0f0f0;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
  }
  .btn-cancel-modal { background: #f0f0f0; color: #444; padding: 10px 22px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; }
  .btn-submit-modal {
    background: linear-gradient(135deg, #FC5D09, #7b0d0d);
    color: #fff;
    padding: 10px 24px;
    border-radius: 8px;
    border: none;
    font-weight: 700;
    cursor: pointer;
  }

  .detail-row { display: flex; gap: 8px; margin-bottom: 10px; font-size: .88rem; flex-wrap: wrap; }
  .detail-row span.dk { font-weight: 700; color: #555; min-width: 160px; }

  @media(max-width:768px) {
    .adm-topbar, .adm-toolbar, .stats-row { padding-left: 14px; padding-right: 14px; }
    .table-wrap { margin: 0 8px 40px; overflow-x: auto; }
    table { min-width: 860px; }
  }
</style>
</head>
<body>

<!-- Top Bar -->
<div class="adm-topbar">
  <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/></svg>
  <h1>&#128260; Refund Management</h1>
  <?php $pending_count = count(array_filter((array)$refunds, function($r){ return $r->status === 'pending'; })); ?>
  <?php if ($pending_count > 0): ?>
    <span class="badge-count">&#9888; <?= $pending_count ?> Pending</span>
  <?php endif; ?>
</div>

<!-- Flash -->
<?php if ($this->session->flashdata('msg')): ?>
  <div class="flash-msg">&#10003; <?= htmlspecialchars($this->session->flashdata('msg')) ?></div>
<?php endif; ?>

<!-- Stats -->
<?php
  $stat_pending  = count(array_filter((array)$refunds, function($r){ return $r->status==='pending'; }));
  $stat_approved = count(array_filter((array)$refunds, function($r){ return $r->status==='approved'; }));
  $stat_refunded = count(array_filter((array)$refunds, function($r){ return $r->status==='refunded'; }));
  $stat_rejected = count(array_filter((array)$refunds, function($r){ return $r->status==='rejected'; }));
  $total_refunded_amt = 0;
  foreach ((array)$refunds as $r) {
    if ($r->status === 'refunded') $total_refunded_amt += floatval($r->approved_refund_amount);
  }
?>
<div class="stats-row">
  <div class="stat-card"><div class="stat-val"><?= count((array)$refunds) ?></div><div class="stat-lbl">Total</div></div>
  <div class="stat-card amber"><div class="stat-val"><?= $stat_pending ?></div><div class="stat-lbl">Pending</div></div>
  <div class="stat-card blue"><div class="stat-val"><?= $stat_approved ?></div><div class="stat-lbl">Approved</div></div>
  <div class="stat-card green"><div class="stat-val"><?= $stat_refunded ?></div><div class="stat-lbl">Refunded</div></div>
  <div class="stat-card gray"><div class="stat-val"><?= $stat_rejected ?></div><div class="stat-lbl">Rejected</div></div>
  <div class="stat-card green"><div class="stat-val">&#8377;<?= number_format($total_refunded_amt,0) ?></div><div class="stat-lbl">Total Refunded</div></div>
</div>

<!-- Toolbar -->
<div class="adm-toolbar">
  <span class="filter-label">Filter:</span>
  <select id="filterStatus" onchange="filterTable()">
    <option value="">All Status</option>
    <option value="pending">Pending</option>
    <option value="approved">Approved</option>
    <option value="refunded">Refunded</option>
    <option value="rejected">Rejected</option>
  </select>
  <select id="filterType" onchange="filterTable()">
    <option value="">All Payment Types</option>
    <option value="advance">Advance</option>
    <option value="final">Final</option>
    <option value="full">Full</option>
  </select>
  <input type="text" id="searchInput" placeholder="Search by booking ID or reason..." oninput="filterTable()" />
  <button class="btn-export" onclick="exportCSV()">&#8681; Export CSV</button>
</div>

<!-- Table -->
<div class="table-wrap">
  <?php if (empty($refunds)): ?>
    <div class="no-records">&#128203; No refund requests found yet.</div>
  <?php else: ?>
  <table id="refundTable">
    <thead>
      <tr>
        <th>#ID</th>
        <th>Booking</th>
        <th>Type</th>
        <th>Paid</th>
        <th>Req. Refund</th>
        <th>Approved</th>
        <th>Reason</th>
        <th>Refund To</th>
        <th>Status</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($refunds as $r): ?>
      <tr data-status="<?= $r->status ?>" data-type="<?= $r->payment_type ?>">
        <td><?= $r->id ?></td>
        <td>
          <strong>#<?= $r->booking_id ?></strong><br>
          <small style="color:#888"><?= htmlspecialchars($r->booking_status ?? 'N/A') ?></small>
        </td>
        <td><span class="pt-<?= $r->payment_type ?>"><?= strtoupper($r->payment_type) ?></span></td>
        <td class="amount-col">&#8377;<?= number_format($r->total_paid_amount, 2) ?></td>
        <td class="amount-col">&#8377;<?= number_format($r->requested_refund_amount, 2) ?></td>
        <td class="amount-approved">
          <?php echo $r->approved_refund_amount > 0 ? '&#8377;'.number_format($r->approved_refund_amount,2) : '<span style="color:#bbb">&#8212;</span>'; ?>
        </td>
        <td style="max-width:150px">
          <div style="font-weight:600;font-size:.84rem"><?= htmlspecialchars($r->cancellation_reason) ?></div>
          <?php if (!empty($r->reason_details)): ?>
            <div style="font-size:.76rem;color:#999;margin-top:3px"><?= htmlspecialchars(substr($r->reason_details,0,55)) ?><?= strlen($r->reason_details)>55?'&hellip;':'' ?></div>
          <?php endif; ?>
        </td>
        <td style="font-size:.82rem">
          <?php if ($r->refund_method === 'upi'): ?>
            <span style="color:#6a1b9a;font-weight:700">UPI</span><br>
            <span style="color:#555"><?= htmlspecialchars($r->upi_id ?? '&#8212;') ?></span>
          <?php elseif ($r->refund_method === 'bank_transfer'): ?>
            <span style="color:#00695c;font-weight:700">Bank</span><br>
            <span style="color:#555"><?= htmlspecialchars(($r->bank_account_no ?? '&#8212;').' / '.($r->bank_ifsc ?? '')) ?></span>
          <?php else: ?>
            <span style="color:#1565c0;font-weight:700">Original Source</span>
          <?php endif; ?>
        </td>
        <td><span class="badge badge-<?= $r->status ?>"><?= ucfirst($r->status) ?></span></td>
        <td style="font-size:.82rem;white-space:nowrap">
          <?= date('d M Y', strtotime($r->created_at)) ?><br>
          <span style="color:#aaa"><?= date('h:i A', strtotime($r->created_at)) ?></span>
        </td>
        <td>
          <div class="action-btns">
            <button class="btn-sm btn-view" onclick="showDetail(<?= htmlspecialchars(json_encode($r), ENT_QUOTES) ?>)">&#128065; View</button>
            <?php if ($r->status === 'pending'): ?>
              <button class="btn-sm btn-approve" onclick="openAction(<?= $r->id ?>, 'approve', <?= floatval($r->requested_refund_amount) ?>)">&#10004; Approve</button>
              <button class="btn-sm btn-reject" onclick="openAction(<?= $r->id ?>, 'reject', 0)">&#10008; Reject</button>
            <?php elseif ($r->status === 'approved'): ?>
              <button class="btn-sm btn-refund" onclick="openAction(<?= $r->id ?>, 'refund', <?= floatval($r->approved_refund_amount) ?>)">&#128184; Refund</button>
            <?php else: ?>
              <span class="btn-sm btn-done">Completed</span>
            <?php endif; ?>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>
</div>

<!-- Action Modal -->
<div class="modal-overlay" id="actionModal">
  <div class="modal-box">
    <div class="modal-head">
      <h3 id="modalTitle">Process Refund</h3>
      <button class="modal-close" onclick="closeModal('actionModal')">&#10005;</button>
    </div>
    <div class="modal-body">
      <form id="actionForm">
        <input type="hidden" id="act_refund_id" name="refund_request_id" />
        <input type="hidden" id="act_action" name="action" />
        <div class="modal-field" id="amountField">
          <label>Approved Refund Amount (&#8377;)</label>
          <input type="number" id="act_amount" name="approved_amount" step="0.01" min="0" placeholder="Enter approved amount" />
          <div class="info-text">Leave 0 to auto-use requested amount.</div>
        </div>
        <div class="modal-field" id="refundIdField" style="display:none">
          <label>Gateway Refund Reference ID <small style="color:#aaa">(Optional)</small></label>
          <input type="text" id="act_gateway_id" name="gateway_refund_id" placeholder="e.g. rfnd_XXXXXXXX" />
        </div>
        <div class="modal-field">
          <label>Admin Remarks</label>
          <textarea id="act_remarks" name="admin_remarks" rows="3" placeholder="Add a remark or reason..."></textarea>
        </div>
      </form>
    </div>
    <div class="modal-foot">
      <button class="btn-cancel-modal" onclick="closeModal('actionModal')">Cancel</button>
      <button class="btn-submit-modal" id="modalSubmitBtn" onclick="submitAction()">Submit</button>
    </div>
  </div>
</div>

<!-- Detail Modal -->
<div class="modal-overlay" id="detailModal">
  <div class="modal-box" style="max-width:660px">
    <div class="modal-head">
      <h3>&#128196; Refund Request Details</h3>
      <button class="modal-close" onclick="closeModal('detailModal')">&#10005;</button>
    </div>
    <div class="modal-body" id="detailBody" style="max-height:70vh;overflow-y:auto"></div>
    <div class="modal-foot">
      <button class="btn-cancel-modal" onclick="closeModal('detailModal')">Close</button>
    </div>
  </div>
</div>

<script>
const BASE_URL = "<?= site_url() ?>";

function filterTable() {
  var status = document.getElementById('filterStatus').value.toLowerCase();
  var type   = document.getElementById('filterType').value.toLowerCase();
  var search = document.getElementById('searchInput').value.toLowerCase();
  document.querySelectorAll('#refundTable tbody tr').forEach(function(row) {
    var s  = row.dataset.status || '';
    var t  = row.dataset.type  || '';
    var txt = row.textContent.toLowerCase();
    var ok = (!status || s===status) && (!type || t===type) && (!search || txt.includes(search));
    row.style.display = ok ? '' : 'none';
  });
}

function openAction(refundId, action, defaultAmt) {
  document.getElementById('act_refund_id').value  = refundId;
  document.getElementById('act_action').value     = action;
  document.getElementById('act_amount').value     = defaultAmt || 0;
  document.getElementById('act_remarks').value    = '';
  document.getElementById('act_gateway_id').value = '';

  var titles = { approve:'✔ Approve Refund', reject:'✘ Reject Refund', refund:'💸 Process Payment Refund' };
  document.getElementById('modalTitle').textContent = titles[action] || 'Action';

  document.getElementById('amountField').style.display   = (action==='approve'||action==='refund') ? '' : 'none';
  document.getElementById('refundIdField').style.display = (action==='refund') ? '' : 'none';

  var colors = { approve:'#1565c0', reject:'#c62828', refund:'#2e7d32' };
  document.getElementById('modalSubmitBtn').style.background = colors[action] || '#FC5D09';

  document.getElementById('actionModal').classList.add('show');
}

function closeModal(id) {
  document.getElementById(id).classList.remove('show');
}

function submitAction() {
  var btn = document.getElementById('modalSubmitBtn');
  btn.textContent = 'Processing…';
  btn.disabled = true;

  var formData = new FormData(document.getElementById('actionForm'));
  fetch(BASE_URL + 'contacts/admin-process-refund', { method:'POST', body:formData })
    .then(function(r){ return r.json(); })
    .then(function(data) {
      if (data.success) {
        closeModal('actionModal');
        showToast('✅ ' + data.message, 'success');
        setTimeout(function(){ location.reload(); }, 1500);
      } else {
        showToast('❌ ' + data.message, 'error');
      }
    })
    .catch(function(){ showToast('❌ Network error, try again.', 'error'); })
    .finally(function(){ btn.textContent='Submit'; btn.disabled=false; });
}

function showDetail(r) {
  var methodMap = { original_source:'⬅ Original Source', upi:'📱 UPI', bank_transfer:'🏦 Bank Transfer' };
  var html = '<div class="detail-row"><span class="dk">Refund ID</span><span>#'+r.id+'</span></div>'
    +'<div class="detail-row"><span class="dk">Booking ID</span><span>#'+r.booking_id+'</span></div>'
    +'<div class="detail-row"><span class="dk">Customer ID</span><span>'+r.customer_id+'</span></div>'
    +'<div class="detail-row"><span class="dk">Payment Type</span><span>'+(r.payment_type||'').toUpperCase()+'</span></div>'
    +'<div class="detail-row"><span class="dk">Total Paid</span><span>&#8377;'+parseFloat(r.total_paid_amount||0).toFixed(2)+'</span></div>'
    +'<div class="detail-row"><span class="dk">Requested Refund</span><span>&#8377;'+parseFloat(r.requested_refund_amount||0).toFixed(2)+'</span></div>'
    +'<div class="detail-row"><span class="dk">Approved Amount</span><span>'+(r.approved_refund_amount>0?'&#8377;'+parseFloat(r.approved_refund_amount).toFixed(2):'&#8212;')+'</span></div>'
    +'<hr style="margin:14px 0;border-color:#f0f0f0">'
    +'<div class="detail-row"><span class="dk">Reason</span><span>'+(r.cancellation_reason||'&#8212;')+'</span></div>'
    +'<div class="detail-row"><span class="dk">Details</span><span>'+(r.reason_details||'&#8212;')+'</span></div>'
    +'<hr style="margin:14px 0;border-color:#f0f0f0">'
    +'<div class="detail-row"><span class="dk">Refund Method</span><span>'+(methodMap[r.refund_method]||r.refund_method)+'</span></div>'
    +(r.upi_id?'<div class="detail-row"><span class="dk">UPI ID</span><span>'+r.upi_id+'</span></div>':'')
    +(r.bank_account_no?'<div class="detail-row"><span class="dk">Account No.</span><span>'+r.bank_account_no+'</span></div>':'')
    +(r.bank_ifsc?'<div class="detail-row"><span class="dk">IFSC</span><span>'+r.bank_ifsc+'</span></div>':'')
    +'<hr style="margin:14px 0;border-color:#f0f0f0">'
    +'<div class="detail-row"><span class="dk">Gateway Payment ID</span><span>'+(r.gateway_payment_id||'&#8212;')+'</span></div>'
    +'<div class="detail-row"><span class="dk">Gateway Refund ID</span><span>'+(r.gateway_refund_id||'&#8212;')+'</span></div>'
    +'<div class="detail-row"><span class="dk">Admin Remarks</span><span>'+(r.admin_remarks||'&#8212;')+'</span></div>'
    +'<div class="detail-row"><span class="dk">Status</span><span><strong>'+(r.status||'').toUpperCase()+'</strong></span></div>'
    +'<div class="detail-row"><span class="dk">Requested On</span><span>'+(r.created_at||'')+'</span></div>'
    +'<div class="detail-row"><span class="dk">Last Updated</span><span>'+(r.updated_at||'')+'</span></div>';
  document.getElementById('detailBody').innerHTML = html;
  document.getElementById('detailModal').classList.add('show');
}

function showToast(msg, type) {
  var toast = document.createElement('div');
  toast.style.cssText = 'position:fixed;bottom:28px;right:28px;z-index:99999;'
    +'background:'+(type==='success'?'#2e7d32':'#c62828')+';color:#fff;'
    +'padding:14px 22px;border-radius:10px;font-weight:700;font-size:.9rem;'
    +'box-shadow:0 8px 30px rgba(0,0,0,.2)';
  toast.textContent = msg;
  document.body.appendChild(toast);
  setTimeout(function(){ toast.remove(); }, 3000);
}

function exportCSV() {
  var rows = [['ID','Booking ID','Type','Paid','Requested','Approved','Reason','Method','Status','Date']];
  document.querySelectorAll('#refundTable tbody tr').forEach(function(row) {
    if (row.style.display !== 'none') {
      var cells = row.querySelectorAll('td');
      rows.push([
        cells[0].textContent.trim(),
        cells[1].textContent.trim().replace(/\n/g,' '),
        cells[2].textContent.trim(),
        cells[3].textContent.trim(),
        cells[4].textContent.trim(),
        cells[5].textContent.trim(),
        cells[6].textContent.trim().replace(/\n/g,' '),
        cells[7].textContent.trim().replace(/\n/g,' '),
        cells[8].textContent.trim(),
        cells[9].textContent.trim().replace(/\n/g,' ')
      ]);
    }
  });
  var csv = rows.map(function(r){ return r.map(function(c){ return '"'+(c||'').replace(/"/g,'""')+'"'; }).join(','); }).join('\n');
  var blob = new Blob([csv],{type:'text/csv'});
  var a = document.createElement('a');
  a.href = URL.createObjectURL(blob);
  a.download = 'refund_requests_' + new Date().toISOString().slice(0,10) + '.csv';
  a.click();
}

document.querySelectorAll('.modal-overlay').forEach(function(el) {
  el.addEventListener('click', function(e) { if (e.target===this) this.classList.remove('show'); });
});
</script>
</body>
</html>
