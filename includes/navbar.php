<ul class="sidebar-nav">
    <li class="sidebar-header">
        -
    </li>

    <li class="sidebar-item <?= ($page === "dashboard") ? 'active' : ''; ?>">
        <a class='sidebar-link' href='index.php'>
            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Farmer Information</span>
        </a>
        <ul id="dashboards" class="sidebar-dropdown list-unstyled" data-bs-parent="#sidebar">
            <li class="sidebar-item  <?= ($page === "farmer_info") ? 'active' : ''; ?>"><a class='sidebar-link' href='farmer_info.php'>Personal Information</a></li>
            <li class="sidebar-item  <?= ($page === "land_info") ? 'active' : ''; ?>"><a class='sidebar-link' href='land_info.php'>Land Information</a></li>
            <li class="sidebar-item  <?= ($page === "cultivated_plants") ? 'active' : ''; ?>"><a class='sidebar-link' href='cultivated_plants.php'>List of Cultivated Plants </a></li>
        </ul>
    </li>

    <li class="sidebar-item  <?= ($page === "agri_assistance") ? 'active' : ''; ?>">
        <a class='sidebar-link' href='agri_assistance.php'>
            <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Agri Assistance</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a data-bs-target="#adversity" data-bs-toggle="collapse" class="sidebar-link">
            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Agri Adversity</span>
        </a>
        <ul id="adversity" class="sidebar-dropdown list-unstyled" data-bs-parent="#sidebar">
            <li class="sidebar-item  <?= ($page === "affected_farmer") ? 'active' : ''; ?>"><a class='sidebar-link' href='agri_beneficiaries.php'>Affected Farmers</a></li>
            <li class="sidebar-item  <?= ($page === "typhoon_report") ? 'active' : ''; ?>"><a class='sidebar-link' href='typhoon_report.php'>Typhoon Report</a></li>
        </ul>
    </li>

</ul>