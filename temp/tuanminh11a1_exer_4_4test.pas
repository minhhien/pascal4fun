program TestProgram;
(*---*)
function cal(x:integer): integer;
begin
	cal := x mod 2 + 1;
end;					
(*---*)
begin
	writeln(cal(#NUM));
end.