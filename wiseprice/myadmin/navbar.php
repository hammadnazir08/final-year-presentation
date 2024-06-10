<div class="sidebar">
    <div class="sidebar-header">
        <a href="index.php" style="text-decoration:none"><h3 style="color:white;">Admin Panel</h3></a>
    </div>
    <ul class="components">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="pending-posts.php">Pending Posts</a></li>
        <li><a href="list.php">Car List</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="settings.php">Settings</a></li>
        <li><a href="logout.php">Logout</a></li>
        
    </ul>
</div>

<style>
.sidebar {
    height: 100vh;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #343a40;
    padding-top: 20px;
    overflow-y: auto;
}
.sidebar .sidebar-header {
    padding: 20px;
    background: #007bff;
    border-bottom: 1px solid #47748b;
}
.sidebar ul.components {
    padding: 20px 0;
}
.sidebar ul li {
    padding: 10px;
    border-bottom: 1px solid #3e4551;
}
.sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
    color: white;
    text-decoration: none;
}
.sidebar ul li a:hover {
    color: #007bff;
    background: #fff;
}
</style>
