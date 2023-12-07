<?php
require "connection.php";

try {
    $query = "SELECT * FROM members";
    $statement = $pdo->query($query);
    $members = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nadsoft</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!--  Fancybox  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


    <script>
        $(document).ready(function() {
            $("[data-fancybox]").fancybox();

            $("#addMemberBtn").click(function() {
                $.fancybox.open({
                    src: '#myModal',
                    type: 'inline'
                });
            });

            $("#saveChangesBtn").click(function() {
                var name = $("#name").val();

                if (name.trim() === "") {
                    alert("Name cannot be empty.");
                    return false;
                }

                $.ajax({
                    url: "add_member.php",
                    type: "POST",
                    data: {
                        parent: $("#parent").val(),
                        name: name
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert("Member added successfully!");
                            // get the new member details
                            var newMemberId = response.newMemberId;
                            var newMemberName = response.memberName;
                            var parentId = response.parentId;

                            // find the selected parent in the existing list
                            var selectedParent = $("#parent option:selected").text();
                            var parentLi = $("li:contains('" + selectedParent + "')");

                            // Apped the new member under parent
                            var newMemberHtml = '<li data-id="' + newMemberId + '">' + newMemberName + '</li>';
                            var parentUl = parentLi.children("ul");

                            // Append insidde dropdown
                            var parentDropdown = $("#parent");
                            var newOption = $('<option>', {
                                value: newMemberId,
                                text: newMemberName
                            });

                            parentDropdown.append(newOption);
                            if (parentUl.length === 0) {
                                // if parent doesn't have a nested ul
                                parentUl = $('<ul>');
                                parentLi.append(parentUl);
                            }
                            parentUl.append(newMemberHtml);

                            $.fancybox.close();
                        } else {
                            alert(response.msg);
                        }
                    },

                    error: function(xhr, status, error) {
                        alert("Error adding member: " + error);
                    }
                });

            });
        });
    </script>
</head>

<body>
    <?php
    class MemberTreeDisplay
    {
        private $members;

        public function __construct(array $members)
        {
            $this->members = $members;
        }

        public function displayTree($parentId = 1)
        {
            echo "<ul>";

            foreach ($this->members as $member) {
                if ($member['ParentId'] == $parentId) {
                    echo "<li>{$member['Name']}";

                    if ($member['Id'] != $member['ParentId']) {
                        $this->displayTree($member['Id']);
                    }

                    echo "</li>";
                }
            }

            echo "</ul>";
        }
    }

    $memberTreeDisplay = new MemberTreeDisplay($members);
    $memberTreeDisplay->displayTree();

    ?>

    <button id="addMemberBtn" data-fancybox data-src="#myModal">Add Member</button>

    <!-- Modal -->
    <div id="myModal" style="display: none;">
        <form>
            <!-- Parent dropdown -->
            <label for="parent">Parent:</label>
            <select name="parent" id="parent">
                <option value="">Select Parent</option>
                <?php foreach ($members as $member) : ?>
                    <option value="<?= $member['Id'] ?>"><?= $member['Name'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <button type="button" id="saveChangesBtn">Save Changes</button>
        </form>
    </div>
</body>

</html>