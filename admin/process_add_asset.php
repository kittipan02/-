<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

function connectToDatabase() {
    $conn = new mysqli("localhost", "root", "", "repair");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function closeConnection($conn, $stmt) {
    if ($stmt !== null && $stmt !== false) {
        $stmt->close();
    }
    $conn->close();
}

function createUploadDirectory($upload_dir) {
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = null;

    try {
        $conn = connectToDatabase();
        $upload_dir = "../upload_files/uploads/";
        createUploadDirectory($upload_dir);        

        $target_file = NULL;

        // Check if file is selected for upload
        if (isset($_FILES["ep_itd_image"]) && $_FILES["ep_itd_image"]["error"] == 0) {
            $file_name = uniqid() . '_' . $_FILES["ep_itd_image"]["name"];
            $target_file = $upload_dir . $file_name;
            move_uploaded_file($_FILES["ep_itd_image"]["tmp_name"], $target_file);
        }         
        
        // Set target_file to NULL if no file is selected
        else {
            $target_file = NULL;
        }

        // Column order in the table
        $column_order = array(
            "ep_et_id", "ep_et_number", "office", "district", "province", "ep_it_name",
            "delivery_note", "ep_brand_id", "ep_un_id", "sequence_number", "serial_number",
            "frame_number", "registration_number", "color", "other_details",
            "warranty_expiration_date", "warranty_company", "warranty_date", "acquisition_source",
            "purchase_contract_date", "ep_itd_price", "budget_used_by",
            "year1_percentage", "year1_remaining_price", "year2_percentage", "year2_remaining_price",
            "year3_percentage", "year3_remaining_price", "year4_percentage", "year4_remaining_price",
            "year5_percentage", "year5_remaining_price", "sale_date", "sale_method",
            "approval_document_number", "sale_price", "profit_loss", "fiscal_year",
            "department_id", "user_name", "head_of_department_id", "year0", "item_list",
            "monthly_or_annual_benefit", "fiscal_year1", "dp_name1", "user_name1", "head_of_department1",
            "fiscal_year2", "dp_name2", "user_name2", "head_of_department2", "fiscal_year3",
            "dp_name3", "user_name3", "head_of_department3", "fiscal_year4", "dp_name4", "user_name4",
            "head_of_department4", "fiscal_year5", "dp_name5", "user_name5", "head_of_department5",
            "fiscal_year6", "dp_name6", "user_name6", "head_of_department6", "year01", "item_list01",
            "monthly_or_annual_benefit01", "year02", "item_list02", "monthly_or_annual_benefit02",
            "year03", "item_list03", "monthly_or_annual_benefit03", "year04", "item_list04",
            "monthly_or_annual_benefit04", "year05", "item_list05", "monthly_or_annual_benefit05",
            "year06", "item_list06", "monthly_or_annual_benefit06", "year07", "item_list07",
            "monthly_or_annual_benefit07", "ep_itd_image"
        );

        $values = array();

        // Populate values from $_POST
        foreach ($column_order as $column) {
            // Check if 'department_id' is sent and not empty
            if ($column === 'department_id') {
                if (!isset($_POST[$column]) || empty($_POST[$column])) {
                    throw new Exception("Error: Department ID is required.");
                }
            }
            $values[$column] = isset($_POST[$column]) ? $_POST[$column] : null;
        }

        // Replace empty values with null
        $values = array_map(function ($value) {
            return $value !== '' ? $value : null;
        }, $values);

        // If a file is uploaded, add its path to $values
        if ($target_file !== NULL) {
            $values["ep_itd_image"] = $target_file;
        } else {
            $values["ep_itd_image"] = '';
        }

        $values["ep_et_number"] = isset($_POST['ep_et_number']) ? $_POST['ep_et_number'] : null;
        $values["ep_et_id"] = isset($_POST['ep_et_id']) ? $_POST['ep_et_id'] : null;
        $values["ep_un_id"] = isset($_POST['ep_un_id']) ? $_POST['ep_un_id'] : null;
        $values["ep_brand_id"] = isset($_POST['ep_brand_id']) ? $_POST['ep_brand_id'] : null;
        $values["department_id"] = isset($_POST['department_id']) ? $_POST['department_id'] : null;
        
        $placeholders = implode(", ", array_fill(0, count($values), "?"));
        $sql = "INSERT INTO equipment_parcels (" . implode(", ", array_keys($values)) . ") VALUES ($placeholders)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt !== false) {
            $param_types = str_repeat('s', count($values));
            $bind_params = [$param_types];
            
            foreach ($values as &$value) {
                $bind_params[] = &$value;
            }
        
            $stmt->bind_param(...$bind_params);

            if ($stmt->execute()) {
                $auto_increment_value = $stmt->insert_id;

                if ($auto_increment_value !== false) {
                    header("Location: display_assets.php");
                    exit();
                } else {
                    throw new Exception("Error fetching auto-increment value.");
                }
            } else {
                $error_message = "Error executing SQL statement: " . $stmt->error;
                throw new Exception($error_message);
            }
        } else {
            $error_message = "Error preparing SQL statement: " . mysqli_error($conn);
            throw new Exception($error_message);
        }
    } catch (Exception $e) {
        echo "Error: An unexpected error occurred. Please try again later. Additional Info: " . $e->getMessage();
    } finally {
        closeConnection($conn, $stmt);
    }
}
?>
