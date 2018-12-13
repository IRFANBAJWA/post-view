<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
.danger{
    background-color: #ff000099 !important;
    color:#fff;
}
.danger td{
    color:#000 !important;
}
.success{
}
.search-block{
    margin-bottom: 20px;
    margin-top:20px;
    display: block;
    overflow: hidden;
}
.search-block #first_date,.search-block #sec_date{
    height: 28px !important;
    margin: 0 4px 0 0;
    border: 1px solid #ddd;
    box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
    background-color: #fff;
    color: #32373c;
    outline: 0;
    font-size:12px;
    transition: 50ms border-color ease-in-out;
}
.search-block form{
    float:left;
}
.updated{
    display:none;
}
td, th {
    border: 0px solid #dddddd !important;
    text-align: left;
    padding: 8px;
}
.downlaod-btn{
    float:right;
}
.downlaod-btn a{
    color:#000;
    text-decoration:none;
}
#dvData table thead th{
    box-shadow:0 2px 2px #ccc;
}
#dvData{
    margin-top:20px;
}
.wrap h2{
    display:inline-block;
    margin-right:5px;
}
.page-refresh{
    position:relative;
    top:10px;
}
</style>
    <div class="wrap">
        <h2><?php _e( 'User visting History', 'user-history-list' ); ?></h2>
        <div  id="dvData">
        <?php 
            global $wpdb;
            $table_user = $wpdb->prefix."user_visit";
            $alluser = $wpdb->get_results( "SELECT * FROM $table_user ORDER BY  id  DESC " );
        ?>
        <div class="sub_title">
            <!--<h3>user vist data</h3>-->
        </div>
        <table class="wp-list-table widefat fixed">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Date</th>
                </tr>
            </thead>
        <tbody id="the-list">
        <?php
        foreach ($alluser as $user) {
        ?>
        <tr class="success">
          <td><?php echo $user->username;?> </td>
          <td><?php echo $user->useremail;?> </td>
          <td><?php echo $user->v_date;?> </td>
        </tr>
        <?php
        }
     ?>
    </tbody></table></div>
        </div>
    </div>