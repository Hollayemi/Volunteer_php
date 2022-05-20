<?php

    function allUsers($conn)
    {
        $sql="SELECT * FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function allAgent($conn)
    {
        $sql="SELECT * FROM agent";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function amountToPay($conn)
    {
        $sql="SELECT withdrawableCashFlow FROM agent";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }

    function updateWithdrawableCashFlow($conn,$myId)
    {
        $sql    = "UPDATE agent SET withdrawableCashFlow=? WHERE id=?";
        $stmt   = $conn->prepare($sql);
        $stmt->execute(['0',$myId]);
        return true;
    }


    function over20Referrals($conn)
    {
        $sql="SELECT * FROM agent WHERE Total_reg > 20 ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }


    function allBusiness($conn)
    {
        $sql="SELECT * FROM marketers";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function allSubscribers($conn)
    {
        $sql="SELECT * FROM subscribers";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function Delete($conn,$myId){
        $sql="DELETE * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$myId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function deleteMarketers($conn,$myId){
        $sql="DELETE FROM marketers WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$myId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function all3_monts($conn)
    {
        $sql="SELECT * FROM subscribers Where type_of_sub = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['3']);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function all6_monts($conn)
    {
        $sql="SELECT * FROM subscribers Where type_of_sub = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['6']);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function all_1_year($conn)
    {
        $sql="SELECT * FROM subscribers Where type_of_sub = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['12']);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

?>