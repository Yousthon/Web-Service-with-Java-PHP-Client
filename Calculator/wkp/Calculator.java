package wkp;

public class Calculator {
	
 public int add(int p1, int p2) {
  return p1 + p2;
 } 
 	
 public int subtract(int p1, int p2) {
  return p1 - p2;
 } 
 	
 public int division(int p1, int p2) {
  	return p1/p2;// division par 0 à gérer dans le code php
 } 

 public int multip(int p1, int p2) {
  	return p1*p2; 
 } 
 	
 public int modulo(int p1, int p2) {
   return p1%p2;// division par 0 à gérer dans le code php
 } 
 	
 public int puissance(int p1, int p2) {
 	double b = (double) p1;
 	double c = (double) p2;
 	return (int) Math.pow(p1,p2);
 } 
 	
}
