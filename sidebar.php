<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Sidebar</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"/>

  <style>
    body {
      background-color: #f8f9fa;
      overflow-x: hidden;
    }

    .sidebar {
      background-color: #343a40;
      color: white;
      padding-top: 20px;
      transition: all 0.3s;
      z-index: 1000;
    }

    /* Desktop */
    @media (min-width: 992px) {
      .sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        overflow-y: auto;
      }

      .sidebar-toggle {
        display: none !important;
      }
    }

    /* Mobile */
    @media (max-width: 991.98px) {
      .sidebar {
        width: 100%;
        position: relative;
        display: none;
      }

      .sidebar.show {
        display: block;
        animation: slideDown 0.3s ease-in-out forwards;
      }

      @keyframes slideDown {
        from {
          opacity: 0;
          transform: scaleY(0);
          transform-origin: top;
        }
        to {
          opacity: 1;
          transform: scaleY(1);
        }
      }

      .sidebar-toggle {
        display: block;
        background-color: #343a40;
        color: white;
        width: 100%;
        text-align: left;
        padding: 10px 15px;
        font-size: 1.2rem;
        border: none;
      }
    }

   
    .sidebar button {
      color: white;
      background-color: transparent;
      border: none;
      width: 100%;
      text-align: left;
      padding: 12px 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 15px;
    }

    .sidebar button:hover {
      background-color: #495057;
    }


    .dropdown-container {
      display: none;
      background-color: #495057;
      padding-left: 15px;
    }

    .dropdown-container button {
      font-size: 14px;
    }
  </style>
</head>

<body>


<button class="sidebar-toggle" onclick="toggleSidebar()">
  <i class="bi bi-list"></i> Menu
</button>


<div class="sidebar" id="sidebarMenu">
  <div class="p-3">
    <h4 class="mb-3">Admin Dashboard</h4>

    <button onclick="location.href='admindashboard.php'">
      <i class="bi bi-house-door"></i> Dashboard
    </button>

    <button onclick="location.href='manageusers.php'">
      <i class="bi bi-people"></i> Manage Users
    </button>

   
    <button class="has-dropdown" onclick="toggleDropdown('employeeDropdown')">
      <i class="bi bi-person-badge"></i> Employee ▼
    </button>
    <div id="employeeDropdown" class="dropdown-container">
      <button onclick="location.href='addemployee.php'">
        <i class="bi bi-person-plus"></i> New Employee
      </button>
      <button onclick="location.href='existingemployee.php'">
        <i class="bi bi-person-lines-fill"></i> Existing Employee
      </button>
    </div>

    <button class="has-dropdown" onclick="toggleDropdown('productDropdown')">
      <i class="bi bi-box"></i> Manage Products ▼
    </button>
    <div id="productDropdown" class="dropdown-container">
      <button onclick="location.href='addproduct.php'">
        <i class="bi bi-plus-circle"></i> Add Product
      </button>
      
      <button onclick="location.href='stocks.php'">
        <i class="bi bi-archive"></i> Update Stocks
      </button>
      <button onclick="location.href='existing_stock.php'">
        <i class="bi bi-archive"></i> Existing Stocks
      </button>
    </div>

   
    <button class="has-dropdown" onclick="toggleDropdown('ordersDropdown')">
      <i class="bi bi-bag"></i> Manage Orders ▼
    </button>
    <div id="ordersDropdown" class="dropdown-container">
      <button onclick="location.href='Neworders.php'">
        <i class="bi bi-bag-plus"></i> New Orders
      </button>
     
      <button onclick="location.href='completedorders.php'">
        <i class="bi bi-check-circle"></i> Completed Orders
      </button>
    </div>
    
    <button onclick="location.href='landingpage.php'">
      <i class="bi bi-box-arrow-right"></i> Logout
    </button>
  </div>
</div>


<script>
  function toggleDropdown(id) {
    let dropdown = document.getElementById(id);
    dropdown.style.display =
      dropdown.style.display === "block" ? "none" : "block";
  }

  function toggleSidebar() {
    document.getElementById("sidebarMenu").classList.toggle("show");
  }

  // FIXED ID BUG HERE
  document.addEventListener("DOMContentLoaded", () => {
    if (window.innerWidth < 992) {
      document.querySelectorAll(".sidebar button").forEach(btn => {
        btn.addEventListener("click", () => {
          if (!btn.classList.contains("has-dropdown")) {
            document.getElementById("sidebarMenu").classList.remove("show");
          }
        });
      });
    }
  });
</script>

</body>
</html>