<div class="footer">
    <p>&copy; <?php echo date("Y"); ?> Your Company. All rights reserved.</p>
</div>

<style>
.footer {
    background-color: #007bff;
    color: white;
    padding: 15px 0;
    position: fixed;
    bottom: 0;
    left: 250px; /* Align with the sidebar */
    width: calc(100% - 250px);
    text-align: center;
}
.footer a {
    color: white;
    text-decoration: none;
}
.footer a:hover {
    text-decoration: underline;
}
.footer .list-inline {
    margin: 0;
    padding: 0;
}
.footer .list-inline-item {
    margin-right: 10px;
}
.footer .list-inline-item:last-child {
    margin-right: 0;
}
</style>
