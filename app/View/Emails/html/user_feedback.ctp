Hi <?php echo $username;?>,
<table>
    <tr>
        <th colspan="2" style="text-align: left">Feedback Form Detail </th>
    </tr>
    <tr>
        <td>Name:</td>
        <td><?php echo (!empty($formData['name'])) ? $formData['name']: '-';?></td>
    </tr>
    <tr>
        <td>Email:</td>
        <td><?php echo (!empty($formData['email'])) ? $formData['email']: '-';?></td>
    </tr>
    <tr>
        <td>Company:</td>
        <td><?php echo (!empty($formData['company'])) ? $formData['company']: '-';?></td>
    </tr>
    <tr>
        <td>Phone:</td>
        <td><?php echo (!empty($formData['phone'])) ? $formData['phone']: '-';?></td>
    </tr>
    <tr>
        <td>Number of employees:</td>
        <td><?php echo (!empty($formData['employeesNumber'])) ? $formData['employeesNumber']: '-';?></td>
    </tr>
    <tr>
        <td>Comment:</td>
        <td><?php echo (!empty($formData['comment'])) ? $formData['comment']: '-';?></td>
    </tr>
   
</table>



Thank you