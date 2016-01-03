program TestProgram;
(*---*)
function cal(x:integer):integer;
	var sum,i: integer;
begin
      	sum:=0;
     	for i:=0 to x do 
            sum:=sum+i;
		   
	    cal:=sum;          
end;					
					
					
					
					
(*---*)
begin
	writeln(cal(#NUM));
end.