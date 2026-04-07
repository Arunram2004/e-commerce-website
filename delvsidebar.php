<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
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

    /* Desktop Sidebar */
    @media (min-width: 992px) {
      .sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        overflow-y: auto;
      }

      .content {
        margin-left: 250px;
        padding: 20px;
      }

      .sidebar-toggle {
        display: none !important;
      }
    }

    /* Mobile Top-Down Sidebar */
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

      .content {
        margin-left: 0;
        padding: 20px;
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
      padding: 10px 20px;
      display: block;
    }

    .sidebar button:hover {
      background-color: #495057;
    }

    .dropdown-container {
      display: none;
      background-color: #495057;
      padding-left: 20px;
    }
    </style>
</head>
<body>
   
   <button class="sidebar-toggle" onclick="toggleSidebar()">
    <span class="d-flex align-items-center">
      <i class="bi bi-list"></i>
    </span>
  </button> 
  
  <div class="sidebar" id="sidebar">
  <h4 class="mb-3">Employee Dashboard</h4>
    <button onclick="location.href='delivery-employeedashboard.php'"><i class="bi bi-house-door"></i> Dashboard</button>
    <button onclick="location.href='dprofileupdate.php'"><i class="bi bi-person-circle me-2"></i> Profile</button>
    <button  onclick="location.href='dassinged-delivery.php'"><i class="bi bi-list-task me-2"></i> Assigned Delivery</button>
    <button  onclick="location.href='dcompleted-delivery.php'"><i class="bi bi-check2-square me-2"></i> Completed Delivery</button>
    <button  onclick="location.href='landingpage.php'"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('show');
    }

    document.addEventListener('DOMContentLoaded', () => {
      if (window.innerWidth < 992) {
        document.querySelectorAll('.sidebar button').forEach(button => {
          button.addEventListener('click', () => {
            if (!button.classList.contains('has-dropdown')) {
              document.getElementById('sidebar').classList.remove('show');
            }
          });
        });
      }
    });
  </script>
</body>
</html>