<?php

$barangay = [
    'name'         => 'Barangay Pinagkawitan',
    'location'     => 'Lipa City, Batangas',
    'office_hours' => 'Monday - Friday, 8:00 AM - 5:00 PM',
    'emergency'    => '911',
];


$requests = [
    ['ref' => 'BRC-2026-0142', 'document' => 'Barangay Clearance',      'filed_days_ago' => 3, 'status' => 'Processing'],
    ['ref' => 'COR-2026-0138', 'document' => 'Certificate of Residency', 'filed_days_ago' => 5, 'status' => 'Processing'],
    ['ref' => 'COI-2026-0127', 'document' => 'Certificate of Indigency', 'filed_days_ago' => 9, 'status' => 'Ready to Claim'],
];

$pendingCount = count(array_filter($requests, fn($r) => $r['status'] === 'Processing'));
$claimCount   = count(array_filter($requests, fn($r) => $r['status'] === 'Ready to Claim'));


$stats = [
    ['icon' => 'bi-people-fill',     'value' => '1,248',        'label' => 'Total Residents',   'note' => 'Registered in the portal'],
    ['icon' => 'bi-hourglass-split', 'value' => $pendingCount,  'label' => 'Pending Requests',  'note' => 'Being processed by the office'],
    ['icon' => 'bi-box-seam',        'value' => $claimCount,    'label' => 'To Claim',          'note' => 'Ready for pick-up'],
];


$services = [
    ['icon' => 'bi-file-earmark-check', 'title' => 'Barangay Clearance',       'desc' => 'For employment, IDs and other general purposes.'],
    ['icon' => 'bi-house-check',        'title' => 'Certificate of Residency', 'desc' => 'Proof that you live in the barangay.'],
    ['icon' => 'bi-heart',              'title' => 'Certificate of Indigency', 'desc' => 'For medical, scholarship and other assistance.'],
    ['icon' => 'bi-shop',               'title' => 'Business Clearance',       'desc' => 'Required for new and renewing local businesses.'],
    ['icon' => 'bi-person-vcard',       'title' => 'Barangay ID',              'desc' => 'Get an official barangay identification card.'],
    ['icon' => 'bi-chat-left-text',     'title' => 'Report a Concern',         'desc' => 'Send a complaint, request or suggestion to the office.'],
];


$announcements = [
    ['tag' => 'Assembly',    'icon' => 'bi-megaphone-fill', 'in_days' => 3, 'title' => 'Barangay Assembly Day',
     'body' => 'All residents are invited to the quarterly assembly to hear project updates and share concerns.'],
    ['tag' => 'Health',      'icon' => 'bi-heart-pulse',    'in_days' => 7, 'title' => 'Free Anti-Rabies Vaccination',
     'body' => 'Bring your dogs and cats to the barangay hall for free vaccination. Please bring a leash or carrier.'],
    ['tag' => 'Environment', 'icon' => 'bi-recycle',        'in_days' => 1, 'title' => 'Waste Segregation Reminder',
     'body' => 'Biodegradable and non-biodegradable waste are collected on separate days. Check the posted schedule.'],
];
