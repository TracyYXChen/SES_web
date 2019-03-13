# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -0.93, 0.98, 18.77, -23.94, -2.86, -15.38, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -7.78, 18.46, -4.09, -17.42, -20.04, 6.74, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 3.52, -7.87, -8.74, -31.33, 7.00, 13.07, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_2')
