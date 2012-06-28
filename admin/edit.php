<form action="">
<label>Title:</label>
<input type="text" name="title"><br>
<label>Subtitle:</label>
<input type="text" name="sub"><br>
<label>Link:</label>
<input type="text" name="link"><br>
<label>Categories:</label>
<input type="text" name="cat"><br>
<label>Image 1:</label>
<input type="file" name="image[0]"><br>
<? for($i=1;$i<=25;$i++): ?>
<input style="display: hidden;" type="file" name="image[<? echo $i; ?>]"><br>
<? endfor; ?>
<input type="submit">
</form>