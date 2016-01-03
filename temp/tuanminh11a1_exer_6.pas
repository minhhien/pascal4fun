program Exercise;
(*---*)
function cal(x:integer):integer;
	var sum,i: integer;
begin
      	sum:=0;
     	for i:=0 to x do 
		begin
        sum:=sum+i;
         	end;
	cal:=sum;          
end;					
(*---*)
begin
end.